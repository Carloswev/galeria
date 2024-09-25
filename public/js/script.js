// Função para abrir o modal
function openModal(img) {
    const modal = document.getElementById("modal");
    const modalImg = document.getElementById("modal-img");
    const captionText = document.getElementById("caption");

    modal.style.display = "flex"; 
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
}


function closeModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "none";
}
function handleFiles(files) {
    const gallery = document.getElementById('gallery');
    gallery.innerHTML = ''; // Limpa a galeria antes de adicionar novas imagens

    [...files].forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.onclick = () => openModal(img);
            gallery.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}


