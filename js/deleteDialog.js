function confirmation(text) {
  swal({
    title: 'Apa kamu yakin?',
    text: 'Data yang dihapus tidak akan kembali!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      window.location = text;
    } else {
      swal({
        title: 'Data batal di hapus',
        text: 'Data aman batal untuk di hapus',
        icon: 'info',
        button: 'Tutup',
      });
    }
  });
}