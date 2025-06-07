<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController
{

    // public function cashCheckout(Request $request)
    // {
    //     $data = $request->validate([
    //         'total' => 'required|numeric',
    //         'cash_received' => 'required|numeric',
    //         'change' => 'required|numeric',
    //         'cart' => 'required|array'
    //     ]);

    //     // Save Sale
    //     $sale = Sale::create([
    //         'total' => $data['total'],
    //         'cash_received' => $data['cash_received'],
    //         'change' => $data['change'],
    //         'payment_type' => 'cash'
    //     ]);


    //     $subtotal = 0;
    //     $message = "🧾 *RECEIPT*\n\n";
    //     // Save each item
    //     foreach ($data['cart'] as $item) {
    //         $itemTotal = $item['price'] * $item['quantity'];
    //         $subtotal += $itemTotal;
    //         $message .= "• {$item['name']} x{$item['quantity']} = $" . number_format($subtotal, 2) . "\n";

    //         SaleItem::create([
    //             'sale_id' => $sale->id,
    //             'product_name' => $item['name'],
    //             'quantity' => $item['quantity'],
    //             'price' => $item['price'],
    //             'total' => $itemTotal,
    //         ]);
    //         // Decrease quantity in products table
    //         $product = Product::where('name', $item['name'])->first(); // Or better: match by ID if available
    //         if ($product) {
    //             $product->qty -= $item['quantity'];
    //             $product->save();
    //         }

    //         $message .= "• {$item['name']} x{$item['quantity']} = $" . number_format($itemTotal, 2) . "\n";

    //         $tax = $subtotal * 0.1;
    //         $discount = 0; // or calculate based on your logic
    //         $total = $subtotal + $tax - $discount;

    //         $message .= "\nSubtotal: $" . number_format($subtotal, 2);
    //         $message .= "\nTax (10%): $" . number_format($tax, 2);
    //         $message .= "\nDiscount: $" . number_format($discount, 2);
    //         $message .= "\n*Total: $" . number_format($total, 2) . "*";
    //         $message .= "\n\n🕒 " . now()->format('Y-m-d H:i');

    //         // Send to Telegram
    //         $botToken = env('TELEGRAM_BOT_TOKEN');
    //         $chatId = env('TELEGRAM_CHAT_ID');

    //         Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
    //             'chat_id' => $chatId,
    //             'text' => $message,
    //             'parse_mode' => 'Markdown'
    //         ]);
    //     }

    //     session()->forget('cart');
    //     return response()->json([
    //         'status' => 'success',
    //         'cart' => $data['cart'],
    //         'subtotal' => $subtotal,
    //         'discount' => 0,
    //     ]);
    // }



    public function cashCheckout(Request $request)
    {
        $data = $request->validate([
            'total' => 'required|numeric',
            'cash_received' => 'required|numeric',
            'change' => 'required|numeric',
            'cart' => 'required|array'
        ]);

        // Save Sale
        $sale = Sale::create([
            'total' => $data['total'],
            'cash_received' => $data['cash_received'],
            'change' => $data['change'],
            'payment_type' => 'cash'
        ]);

        $subtotal = 0;
        $message = "🧾 *RECEIPT*\n\n";

        foreach ($data['cart'] as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $subtotal += $itemTotal;

            // Save item
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $itemTotal,
            ]);

            // Decrease quantity in products table
            $product = Product::where('name', $item['name'])->first(); // Or better: match by ID if available
            if ($product) {
                $product->qty -= $item['quantity'];
                $product->save();
            }

            $message .= "• {$item['name']} x{$item['quantity']} = $" . number_format($itemTotal, 2) . "\n";
        }

        $tax = $subtotal * 0.1;
        $discount = 0;
        $total = $subtotal + $tax - $discount;

        $message .= "\nSubtotal: $" . number_format($subtotal, 2);
        $message .= "\nTax (10%): $" . number_format($tax, 2);
        $message .= "\nDiscount: $" . number_format($discount, 2);
        $message .= "\n*Total: $" . number_format($total, 2) . "*";
        $message .= "\n\n🕒 " . now()->format('Y-m-d H:i');

        // Send to Telegram
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);

        session()->forget('cart');

        return response()->json([
            'status' => 'success',
            'cart' => $data['cart'],
            'subtotal' => $subtotal,
            'discount' => $discount,
        ]);
    }


    public function qrPayment(Request $request)
    {
        $data = $request->validate([
            'total' => 'required|numeric',
            'cart' => 'required|array'
        ]);

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'total' => $data['total'],
                'cash_received' => 0,
                'change' => 0,
                'payment_type' => 'qr'
            ]);

            $subtotal = 0;
            $message = "🧾 *RECEIPT*\n\n";

            foreach ($data['cart'] as $item) {
                $itemTotal = $item['price'] * $item['quantity'];
                $subtotal += $itemTotal;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $itemTotal,
                ]);

                // Decrease quantity in products table
                $product = Product::where('name', $item['name'])->first(); // Or better: match by ID if available
                if ($product) {
                    $product->qty -= $item['quantity'];
                    $product->save();
                }

                $message .= "• {$item['name']} x{$item['quantity']} = $" . number_format($itemTotal, 2) . "\n";
            }

            $tax = $subtotal * 0.1;
            $discount = 0; // or calculate based on your logic
            $total = $subtotal + $tax - $discount;

            $message .= "\nSubtotal: $" . number_format($subtotal, 2);
            $message .= "\nTax (10%): $" . number_format($tax, 2);
            $message .= "\nDiscount: $" . number_format($discount, 2);
            $message .= "\n*Total: $" . number_format($total, 2) . "*";
            $message .= "\n\n🕒 " . now()->format('Y-m-d H:i');

            // Send to Telegram
            $botToken = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_ID');

            Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown'
            ]);

            DB::commit();
            session()->forget('cart');

            return response()->json([
                'status' => 'success',
                'cart' => $data['cart'],
                'subtotal' => $subtotal,
                'discount' => 0,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'QR Payment failed.'], 500);
        }
    }
}
