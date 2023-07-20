<div class="modal" id="modal_jurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="exampleModalLabel"><small>Laporan Jurnal</small><br> <b>{{ $detail->no_transaksi }}</b><span
                        class="detail_header"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="table-jurnal_show" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nomor Akun</th>
                        <th>Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                    </thead>
                    <tbody class="isi_jurnal_show">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Total:</th>
                            <th>{{ \Helper::rupiah($detail->total) }}</th>
                            <th>{{ \Helper::rupiah($detail->total) }}</th>
                        </tr>
                    </tfoot>
                </table>


            </div>
            <div class="modal-footer">



            </div>
        </div>
    </div>
</div>
