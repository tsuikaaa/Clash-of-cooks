const btnLogin    = document.getElementById('btn-login');
const btnRegister = document.getElementById('btn-register');
const formLogin   = document.getElementById('form-login');
const formRegister= document.getElementById('form-register');
const formTitle   = document.getElementById('form-title');

btnLogin.addEventListener('click', () => {
  btnLogin.classList.add('active');
  btnRegister.classList.remove('active');
  formLogin.classList.remove('hidden');
  formRegister.classList.add('hidden');
  formTitle.textContent = 'Se connecter';
});

btnRegister.addEventListener('click', () => {
  btnRegister.classList.add('active');
  btnLogin.classList.remove('active');
  formRegister.classList.remove('hidden');
  formLogin.classList.add('hidden');
  formTitle.textContent = "S'inscrire";
});
