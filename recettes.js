// ouvrir le modal au clic sur "voir"
document.querySelectorAll('.btn-voir').forEach(btn => {
  btn.addEventListener('click', () => {
    const img   = btn.dataset.img;
    const nom   = btn.dataset.nom;
    const pseudo = btn.dataset.pseudo;
    const desc  = btn.dataset.description;

    // image
    document.getElementById('modal-img').src = img;

    // texte
    document.getElementById('modal-pseudo').textContent = pseudo;
    document.getElementById('modal-nom').textContent = nom;
    document.getElementById('modal-description').textContent = desc;

    // afficher le popup
    document.getElementById('modal-overlay').style.display = 'flex';
  });
});

// références pour la fermeture
const overlay = document.getElementById('modal-overlay');
const closeBtn = document.querySelector('.modal-close');

// fermer via la croix
closeBtn.addEventListener('click', () => {
  overlay.style.display = 'none';
});

// fermer en cliquant en dehors de la boîte
overlay.addEventListener('click', e => {
  if (e.target === overlay) {
    overlay.style.display = 'none';
  }
});
