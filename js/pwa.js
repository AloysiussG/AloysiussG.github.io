// --- SERVICE WORKER PWA ---

if ("serviceWorker" in navigator) {
  navigator.serviceWorker
    .register("./service-worker.js")
    .then((registration) => {
      console.log("Service Worker berhasil diregistrasi!");
      console.log(registration);
    })
    .catch((error) => {
      console.log("Service Worker gagal diregistrasi!");
      console.log(error);
    });
}
