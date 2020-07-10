<form class="form-horizontal" role="form" method="POST" action="{{route('komentar.jawaban.simpan', $jawaban->id)}}">
@csrf
    <div class="form-group">
        <div class="col-lg-12">
            <center><label>Komentar</label></center>
            <textarea placeholder="Keterangan Transaksi" class="form-control" name="komentar" id="komentar" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>            
        <button type="submit" class="btn btn-primary waves-effect" name="ubah">Ubah</button>
    </form>
</div>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'jawaban' );
    CKEDITOR.replace( 'komentar' );
    CKEDITOR.replace( 'komentar_pertanyaan' );
</script>