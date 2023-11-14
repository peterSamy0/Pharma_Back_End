<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
 .card-footer .page-item.active .page-link {
        background-color: blue !important;
        color: white !important;
    }
       table.table-sm th,
    td {
        text-align: center;
    }

    .card {
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #eceef3;
        border-radius: 0.75rem;
    }
    table.table-sm tbody tr:not(.showData) {
        border-bottom: 1px solid #e7eaf0;
       
    }
    tr.showData {
        border-bottom: 1px solid #e7eaf0;
    }
    </style>
</head>
<body>
    <div class=" content-wrapper ">
        
        <div class="text-center mb-3">
            <input type="text" id="search-input" class="form-control" placeholder="Search by name">
           </div>
        @if(isset($orders))
            <div id="displayTourguideDetails"></div>
            <div class="card"> 
           <h1 class="text-center">Order</h1>
           <div class="table-responsive">
            <table id="data-table" class="table  table-sm shadow border-0">
                <thead class="thead-light" >
                     <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                       <th>Pharmacy Name</th> 
                        <th>Delivery Name</th> 
                        <th>Show</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order->client->user['name'] }}</td>
                            <td>{{ $order->pharmacy->user['name'] }}</td>
                            <td>{{ $order->delivery->user['name'] }}</td>
                            
                          
                            <td>
                                <a class="btn " style="background-color: #3c6167; color:#e7eaf0 " href="javascript:void(0);" onclick="showOrderDetails({{ $order->id }})">
                                   Show 
                                   {{-- <i class="fas fa-eye"></i> --}}
                                   {{-- @dump($order->id) --}}
                                </a>
                            </td>
                            <td>
                                <button type="button" onclick="showSweetAlert('{{ route('orders.destroy', $order['id']) }}')" class="btn btn-danger">
                                    Delete
                                     {{-- <i class="bi bi-trash"></i> --}}
                                </button>
                                <form id="deleteForm" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </td>
                            <tr class="showData ">
                                <td colspan="12">
                                    <div class="details-div" id="details_{{ $order->id }}" style="display: none;"></div>
                                    {{-- @dump($order->id) --}}
                                </td>
                            </tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example mt-5">
                <ul class="pagination justify-content-center mt-5">
{{$orders->links()}}
                </ul>
            </nav>
           </div>
        </div>
        @endif
        </div>
        <div class="card-footer border-0 py-5">
            <span class="text-muted text-sm">
              Showing  items 
            </span>
            <nav aria-label="Page navigation example">
              {{-- {!! $medications->links() !!}   --}}
            </nav>    
          </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function showSweetAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                preConfirm: () => {
                  
                    const deleteForm = document.getElementById('deleteForm');
                    deleteForm.action = url;
                    deleteForm.style.display = 'block';
                    deleteForm.submit();
                }
            });
        }

        function showOrderDetails(orderId) {
            if ($('#details_' + orderId).is(':visible')) {
                $('#details_' + orderId).hide();
            } else {
                $.get(`/orders/${orderId}`, function (data) {
                    $('.details-div').hide();
                    $('#details_' + orderId).html(data).show();
                });
            }
            
        }

    </script>
    {{-- search --}}
 <script>
    document.getElementById('search-input').addEventListener('keyup', function() {
        const searchQuery = this.value.toLowerCase();
        const table = document.getElementById('data-table');
        const rows = table.querySelectorAll('tbody > tr');

        for (let row of rows) {
            const isShowData = row.classList.contains('showData');

            if (!isShowData) {
                const cells = row.querySelectorAll('td');
                let shouldDisplay = false;

                for (let cell of cells) {
                    const text = cell.textContent || cell.innerText;
                    if (text.toLowerCase().indexOf(searchQuery) > -1) {
                        shouldDisplay = true;
                        break;
                    }
                }

                row.style.display = shouldDisplay ? '' : 'none';

                // If the parent row is hidden, hide the child showData row
                const showDataRow = row.nextElementSibling;
                if (showDataRow && showDataRow.classList.contains('showData')) {
                    showDataRow.style.display = shouldDisplay ? '' : 'none';
                }
            }
        }
    });
</script>

</body>
</html>