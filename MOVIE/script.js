document.addEventListener('DOMContentLoaded', () => {
  const loginToggle = document.getElementById('loginToggle');
  const signupToggle = document.getElementById('signupToggle');
  const formContainer = document.getElementById('formContainer');

  // Check if elements exist before adding event listeners
  if (loginToggle && signupToggle && formContainer) {
    loginToggle.addEventListener('click', () => {
      loginToggle.classList.add('active');
      signupToggle.classList.remove('active');

      formContainer.innerHTML = `
        <form id="loginForm" class="form" action="login_action.php" method="POST" onsubmit="return validateLoginForm()">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit" class="btn">Log In</button>
        </form>
      `;
    });

    signupToggle.addEventListener('click', () => {
      window.location.href = '../registration/registration.php';
    });
  }
});


