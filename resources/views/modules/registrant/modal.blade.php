<div class="modal fade" id="confirm_payment" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Konfirmasi Pembayaran</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ url('registrant/confirm_payment') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-1">
                            <i class="ni ni-notification-70"></i></span>
                        </div>
                        <div class="col-md-11">
                            <p>Apabila pembayaran dicicil, masukkan total semua pembayaran</p>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="payment_number"><h5>Jumlah Pembayaran</h5></label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bag-17"></i></span>
                            </div>
                            <input class="form-control" name="payment_number" id="payment_number" type="number" required>
                            <input name="transaction_id" id="transaction_id" type="hidden">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="payment_evident"><h5>Bukti Pembayaran</h5></label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                            </div>
                            <input class="form-control" name="payment_evidence" id="payment_evident" type="file" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Konfirmasi">
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Tutup</button>
                </div>

            </form>
        </div>
    </div>
</div>
