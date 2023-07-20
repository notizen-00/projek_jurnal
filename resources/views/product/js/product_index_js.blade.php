{{-- <script>
  $(document).ready(function () {

      const channel = Echo.private('private.app');
      channel.subscribed(() => {
          console.log('subsribed');
      }).listen('.app-gudang', (e) => {
          console.log(e.data);

          const gudangArray = e.data; // Convert the PHP array to a JavaScript array          
var html = '';

gudangArray.forEach(function(gudang) {
html += `
  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
      <div class="card-header text-muted border-bottom-0">
        GUID-${gudang.id.toString().padStart(3, '0')}
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b>${gudang.nama_gudang}</b></h2>
            <p class="text-muted text-sm"><b>Alamat : </b>${gudang.alamat}</p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-circle"></i></span>Jumlah produk: ${gudang.total_produk}</li>
            </ul>
          </div>
          <div class="col-5 text-center">
            <i class="fas fa-warehouse fa-4x"></i>
          </div>
        </div>
      </div>
      <div class="card-footer bg-default">
        <div class="text-right">
          <a href="#" class="btn btn-sm btn-success">
            <i class="fas fa-edit"></i> Edit
          </a>
          <a href="#" class="btn btn-sm btn-primary detail_gudang" data-id="${gudang.id}">
            <i class="fas fa-eye"></i> Liat Detail
          </a>
        </div>
      </div>
    </div>
  </div>
`;
});

// Masukkan HTML ke dalam elemen dengan id "cards-container"
var cardsContainer = document.getElementById('cards-container');
cardsContainer.innerHTML = html;


      })
  })

</script> --}}
