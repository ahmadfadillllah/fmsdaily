document.onkeydown = function (e) {
    // Mencegah F12 (Inspect Element)
    if (e.keyCode === 123) {
      Swal.fire({
        icon: 'warning',
        title: 'Akses Terbatas',
        text: 'Anda tidak diizinkan membuka Developer Tools!',
        showConfirmButton: false,
        timer: 2000
      });
      return false;
    }

    // Mencegah Ctrl + Shift + I (Inspect Element)
    if (e.ctrlKey && e.shiftKey && e.keyCode === 'I'.charCodeAt(0)) {
      Swal.fire({
        icon: 'warning',
        title: 'Akses Terbatas',
        text: 'Anda tidak diizinkan membuka Developer Tools!',
        showConfirmButton: false,
        timer: 2000
      });
      return false;
    }

    // Mencegah Ctrl + Shift + J (Console)
    if (e.ctrlKey && e.shiftKey && e.keyCode === 'J'.charCodeAt(0)) {
      Swal.fire({
        icon: 'warning',
        title: 'Akses Terbatas',
        text: 'Anda tidak diizinkan membuka Developer Tools!',
        showConfirmButton: false,
        timer: 2000
      });
      return false;
    }

    // Mencegah Ctrl + U (View Source)
    if (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0)) {
      Swal.fire({
        icon: 'warning',
        title: 'Akses Terbatas',
        text: 'Anda tidak diizinkan membuka Developer Tools!',
        showConfirmButton: false,
        timer: 2000
      });
      return false;
    }
  };
