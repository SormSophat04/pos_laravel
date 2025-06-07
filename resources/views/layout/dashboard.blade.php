@extends('layout.app')

@section('dashboard_content')
    <section class="lg:w-2/3">
        <style>
            .stat-card {
                background: white;
                color: black;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            }

            .section-card {
                background-color: white;
                border-radius: 20px;
                padding: 20px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            }

            .section-title {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 15px;
            }

            .recent-orders th,
            .recent-orders td {
                font-size: 14px;
            }

            .balance {
                font-size: 24px;
                font-weight: bold;
            }

            .activity-item {
                font-size: 14px;
                margin-bottom: 15px;
            }

            .category-box {
                background-color: #f9fafe;
                border-radius: 12px;
                padding: 15px;
                text-align: center;
                font-size: 14px;
                font-weight: 500;
            }
        </style>
        <div class="bg-white rounded-xl shadow-md p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-blue-600">POS Dashboard</h2>
                <div>
                    <button class="btn btn-light me-2"><i class="bi bi-search"></i></button>
                    <button class="btn btn-light"><i class="bi bi-calendar3"></i></button>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div>
                            <i class="bi bi-people-fill fs-1 me-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-2 fw-bold fs-5 text-blue-600">{{__('message.total_customer')}}</h6>
                            <h4>{{ $totalCustomers }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div>
                            <i class="bi bi-cash-stack fs-1 me-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-2 fw-bold fs-5 text-blue-600">{{__('message.total_amount')}}</h6>
                            <h4>${{ number_format($totalAmount, 2) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div>
                            <i class="bi bi-basket2 fs-1 me-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-2 fw-bold fs-5 text-blue-600">{{__('message.total_order')}}</h6>
                            <h4>{{ $totalOrders }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Main Column -->
                <div class="col-lg-12">
                    {{-- <div class="section-card">
                        <div class="section-title text-blue-600">Total Stocks</div>
                        <h5>$2,530</h5>
                        <p class="text-muted">September 2021</p>
                        <div style="height:100px;background-color:#f0f0f0;border-radius:10px;">
                            @foreach ($products as $product)
                                <div class="gap-3">
                                    <div class="d-flex">
                                        <div style="height: 50px">
                                            <img src="{{asset($product->image)}}" alt="img" class="w-100 h-100 object-cover">
                                        </div>
                                        <h3>{{$stocks}}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                    <!-- Recent Orders -->
                    {{-- <div class="section-card mt-4">
                        <div class="section-title d-flex justify-content-between">
                            <span class="text-blue-600">History Orders</span>
                            <a href="#" class="text-primary small" id="toggleLink">See More</a>
                        </div>

                        <div id="tableContainer" style="max-height: 680px; overflow-y: auto; transition: max-height 0.3s;">
                            <table class="table table-hover recent-orders">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('message.name')}}</th>
                                        <th>{{__('message.quantity')}}</th>
                                        <th>{{__('message.price')}}</th>
                                        <th>{{__('message.date')}}</th>
                                        <th>{{__('message.activity')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>${{ $order->price }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td><a class="btn badge bg-warning hover:text-blue-500">{{__('message.view')}}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> --}}

                    <div id="tableContainer" class="overflow-y-auto max-h-[680px] transition-all duration-300">
                        <table class="table-auto w-full text-left border-separate border-spacing-y-2">
                            <thead class="bg-blue-50  sticky top-0 z-10">
                                <tr class="text-blue-700">
                                    <th class="py-3 px-4 font-medium rounded-l-lg">#</th>
                                    <th class="py-3 px-4 font-medium">{{ __('message.name') }}</th>
                                    <th class="py-3 px-4 font-medium">{{ __('message.quantity') }}</th>
                                    <th class="py-3 px-4 font-medium">{{ __('message.price') }}</th>
                                    <th class="py-3 px-4 font-medium">{{ __('message.date') }}</th>
                                    <th class="py-3 px-4 font-medium rounded-r-lg">{{ __('message.activity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="bg-gray-50 hover:bg-gray-100 transition-colors rounded-lg">
                                        <td class="py-3 px-4 border-t border-gray-200">{{ $order->item_id }}</td>
                                        <td class="py-3 px-4 border-t border-gray-200">{{ $order->product_name }}</td>
                                        <td class="py-3 px-4 border-t border-gray-200">{{ $order->quantity }}</td>
                                        <td class="py-3 px-4 border-t border-gray-200">
                                            ${{ number_format($order->price, 2) }}</td>
                                        <td class="py-3 px-4 border-t border-gray-200"
                                            data-date="{{ $order->created_at }}">{{ $order->created_at }}</td>
                                        <td class="py-3 px-4 border-t border-gray-200">
                                            <a href="#"
                                                class="btn badge bg-yellow-400 text-gray-800 hover:bg-yellow-500 px-3 py-1 rounded-full transition-colors view-btn"
                                                data-order="{{ json_encode([
                                                    'sale_id' => $order->sale_id,
                                                    'item_id' => $order->item_id,
                                                    'product_name' => $order->product_name,
                                                    'quantity' => $order->quantity,
                                                    'price' => $order->price,
                                                    'item_total' => $order->item_total,
                                                    'sale_total' => $order->sale_total,
                                                    'cash_received' => $order->cash_received,
                                                    'change' => $order->change,
                                                    'payment_type' => $order->payment_type,
                                                    'created_at' => $order->created_at,
                                                ]) }}">View</a>
                                            {{-- <span class="expired-message text-red-500 text-sm ml-2 hidden">Order
                                                Expired</span> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- JavaScript for expired message and view alert -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Handle expired message
                            const rows = document.querySelectorAll('tbody tr');
                            rows.forEach(row => {
                                try {
                                    const dateCell = row.querySelector('td[data-date]');
                                    const expiredMessage = row.querySelector('.expired-message');
                                    const orderDate = new Date(dateCell.getAttribute('data-date'));
                                    if (isNaN(orderDate)) throw new Error('Invalid date format');

                                    const oneDayAfter = new Date(orderDate);
                                    oneDayAfter.setDate(orderDate.getDate() + 1);
                                    const now = new Date('2025-06-02T22:58:00+07:00'); // Current date and time

                                    if (now > oneDayAfter) {
                                        expiredMessage.classList.remove('hidden');
                                    }
                                } catch (error) {
                                    console.error('Error processing expiration date:', error);
                                }
                            });

                            // Handle view button click
                            const viewButtons = document.querySelectorAll('.view-btn');
                            viewButtons.forEach(button => {
                                button.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    try {
                                        const order = JSON.parse(this.getAttribute('data-order'));
                                        const message = `

                            <div class="space-y-2">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Sale ID:</span>
                                    <span>${order.sale_id || 'N/A'}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Item ID:</span>
                                    <span>${order.item_id || 'N/A'}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Product Name:</span>
                                    <span>${order.product_name || 'Unknown'}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Quantity:</span>
                                    <span>${order.quantity || 0}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Price:</span>
                                    <span>$${(parseFloat(order.price || 0)).toFixed(2)}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Item Total:</span>
                                    <span>$${(parseFloat(order.item_total || 0)).toFixed(2)}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Sale Total:</span>
                                    <span>$${(parseFloat(order.sale_total || 0)).toFixed(2)}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Cash Received:</span>
                                    <span>$${(parseFloat(order.cash_received || 0)).toFixed(2)}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Change:</span>
                                    <span>$${(parseFloat(order.change || 0)).toFixed(2)}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="font-semibold">Payment Type:</span>
                                    <span>${order.payment_type || 'Unknown'}</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="font-semibold">Date:</span>
                                    <span>${order.created_at ? new Date(order.created_at).toLocaleString('en-GB', { timeZone: 'Asia/Bangkok' }) : 'N/A'}</span>
                                </div>
                            </div>
                                    `;
                                        Swal.fire({
                                            title: 'Order Details',
                                            html: message,
                                            icon: 'info',
                                            confirmButtonText: 'Close',
                                            confirmButtonColor: '#2563eb'
                                        });
                                    } catch (error) {
                                        console.error('Error parsing order data:', error);
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Failed to load order details. Please try again.',
                                            icon: 'error',
                                            confirmButtonText: 'Close',
                                            confirmButtonColor: '#dc2626'
                                        });
                                    }
                                });
                            });
                        });
                    </script>

                    <!-- Optional CSS for additional styling -->
                    <style>
                        .section-card {
                            transition: all 0.3s ease;
                        }

                        .table th,
                        .table td {
                            min-width: 100px;
                        }

                        .table tbody tr {
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                        }

                        .expired-message {
                            font-weight: 500;
                        }
                    </style>
                </div>
            </div>
        </div>
        <script>
            const toggleLink = document.getElementById('toggleLink');
            const container = document.getElementById('tableContainer');

            let isExpanded = false;

            toggleLink.addEventListener('click', function(e) {
                e.preventDefault();

                if (!isExpanded) {
                    container.style.maxHeight = 'none';
                    container.style.overflowY = 'visible';
                    toggleLink.textContent = 'See less';
                } else {
                    container.style.maxHeight = '440px';
                    container.style.overflowY = 'auto';
                    toggleLink.textContent = 'See More';
                }

                isExpanded = !isExpanded;
            });
        </script>
    </section>
@endsection

@section('summary_content')
    <section class="lg:w-1/3">
        <div class="bg-white rounded-xl shadow-md p-4 sticky top-4">
            <div class="row g-4">
                <!-- Sidebar Column -->
                <div class="col-lg-12">
                    <div class="section-card mb-4">
                        <div class="section-title">Balance</div>
                        <div class="balance">${{ number_format($totalBalance, 2) }}</div>
                        <div class="text-danger mt-1">tax(10%): ${{ $totalAmount - $totalBalance }}</div>
                        {{-- <div class="text-danger">▼ $1,062.90</div> --}}
                    </div>

                    <div class="section-card mb-4">
                        <div class="section-title d-flex justify-content-between">
                            <span class="text-blue-600">{{__('message.activity')}}</span>
                            <a href="#" class="text-primary small">Role</a>
                        </div>
                        @foreach ($cashiers as $cashier)
                            <div class="activity-item">
                                <strong>{{ $cashier->name }}</strong>
                                <span class="float-end">{{$cashier->role}}</span><br>
                                <small class="text-muted">{{ $cashier->time }}</small>
                            </div>
                        @endforeach

                    </div>

                    <div class="section-card">
                        <div class="section-title">Export</div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('export.sale.items') }}" class="category-box flex align-items-center me-2">
                                <img width="40" src="https://cdn-icons-png.flaticon.com/128/732/732220.png"
                                    alt="">
                                <span class="ms-3 fs-4">Excel</span>
                            </a>
                            <div class="category-box flex-fill ms-2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
