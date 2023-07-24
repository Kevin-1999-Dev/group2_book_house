@extends('layouts.master')
@section('title')
    Cart
@endsection
@section('content')
    <div class="cart">
        <div class="col-11 col-lg-10 clearfix mx-auto mt-5 mt-md-0">
            <h3 class="f-3">Carts</h3>
            <div class="card">
                <div class="card-header">
                    <h3 class="f-4">Cart</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover f-6">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Title</th>
                                <td scope="col">Price</td>
                                <td scope="col"><span class="d-none d-lg-block">Quantity</span><span
                                        class="d-lg-none">Qty</span></td>
                                <td scope="col"><span class="d-none d-lg-block">Action</span><span
                                        class="d-lg-none">Act</span></td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <br />
            <div class="mt-2 clearfix">
                <h5 class="float-end border border-dark p-1 f-6">Total : <span id="totalPrice"></span>MMK</h5>
            </div>
            <form action="{{ route('public.cart.store') }}" method="post" class="mb-3 float-end">
                @csrf
                <div class="form-group mt-3">
                    <label for="payment" class="f-6 mb-1">Payment</label>
                    <select class="form-control f-6" name="payment">
                        @foreach ($payments as $payment)
                            @if (old('payment') == $payment->id)
                                <option value="{{ $payment->id }}" selected>{{ $payment->name }}</option>
                            @else
                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-4">
                    <a href="{{ url()->previous() }}"><span class="btn btn-secondary">Back</span></a>
                    <button class="btn btn-primary" id="orderSubmitBtn">Order</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Remove</h1>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger delete" id="deleteModalDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateTable() {
            axios.get("{{ route('public.cart.info') }}")
                .then(function(response) {
                    document.getElementById('totalItem').innerHTML = response.data['totalItem'];
                    let tableBody = document.createElement('tbody');
                    let totalPrice = 0;
                    if (response.data['book'] != null && response.data['book'].length != 0) {
                        for (const obj of Object.values(response.data['book'])) {
                            const tr = document.createElement('tr');
                            let td = document.createElement('td');
                            td.innerText = 'Book';
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerText = obj['title'];
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerText = obj['price'];
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerHTML = obj['quantity'];
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerHTML =
                                '<button type="button" class="btn btn-sm btn-danger ml-2" data-bs-toggle="modal" data-bs-target="#deleteModal" ' +
                                'data-bs-modal-id="' + obj['id'] + '"' + 'data-bs-modal-type="book"' +
                                'data-bs-modal-title="' + obj['title'] + '"' +
                                '><span class="d-none d-lg-block">Remove All</span><i class="fa-solid fa-trash d-lg-none"></i></button>'
                            tr.appendChild(td);
                            tableBody.appendChild(tr);
                            totalPrice = totalPrice + (obj['price'] * obj['quantity']);
                        }
                    }
                    if (response.data['ebook'] != null && response.data['ebook'].length != 0) {
                        for (const obj of Object.values(response.data['ebook'])) {
                            const tr = document.createElement('tr');
                            let td = document.createElement('td');
                            td.innerText = 'Ebook';
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerText = obj['title'];
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerText = obj['price'];
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerText = '';
                            tr.appendChild(td);
                            td = document.createElement('td');
                            td.innerHTML =
                                '<button type="button" class="btn btn-sm btn-danger ml-2" data-bs-toggle="modal" data-bs-target="#deleteModal" ' +
                                'data-bs-modal-id="' + obj['id'] + '"' + 'data-bs-modal-type="ebook" ' +
                                'data-bs-modal-title="' + obj['title'] + '"' +
                                '><span class="d-none d-lg-block">Remove All</span><i class="fa-solid fa-trash d-lg-none"></i></button>'
                            tr.appendChild(td);
                            tableBody.appendChild(tr);
                            totalPrice = totalPrice + (obj['price']);
                        }
                    }
                    const old_tbody = document.querySelector('tbody')
                    old_tbody.parentNode.replaceChild(tableBody, old_tbody)
                    document.getElementById('totalPrice').innerHTML = totalPrice;
                    if (response.data['totalItem'] == null || response.data['totalItem'] == 0) {
                        document.getElementById('orderSubmitBtn').style.display = "none";
                    } else {
                        document.getElementById('orderSubmitBtn').style.display = "";
                    }
                })
                .catch(function(error) {
                    alert(error);
                })
        }

        updateTable();
        let id, type;
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            id = button.getAttribute('data-bs-modal-id');
            type = button.getAttribute('data-bs-modal-type');
            const modalTitle = deleteModal.querySelector('.modal-title');
            const modalBody = deleteModal.querySelector('.modal-body');
            modalTitle.textContent = "Remove " + type + "?";
            modalBody.textContent = button.getAttribute('data-bs-modal-title');
        });
        const selectedDeleteModal = new bootstrap.Modal(deleteModal);
        var deleteModalDeleteBtn = document.getElementById('deleteModalDeleteBtn');
        deleteModalDeleteBtn.addEventListener('click', function() {
            const modalFooterLink = deleteModal.querySelector('.modal-footer .delete');
            axios.get(`/cart/delete/${type}/${id}`)
                .then(function() {
                    updateTable();
                })
                .catch(function(error) {
                    alert(error);
                })
                .finally(function() {
                    selectedDeleteModal.hide();
                })
        });
    </script>
@endsection
