(function () {
  const storageKey = 'sairamMovieHubLocalUser';
  const readUser = () => {
    try { return JSON.parse(localStorage.getItem(storageKey) || 'null'); } catch (_) { return null; }
  };
  const saveUser = (name, email) => {
    const user = { name: (name || 'Movie Fan').trim(), email: (email || '').trim() };
    localStorage.setItem(storageKey, JSON.stringify(user));
    renderUser();
    if (window.closeLoginModal) window.closeLoginModal();
    return user;
  };
  const signIn = () => {
    const email = prompt('Demo sign-in: enter your email (stored only in this browser).');
    if (email === null) return;
    const name = prompt('What name should we show?', email.split('@')[0] || 'Movie Fan');
    if (name === null) return;
    saveUser(name, email);
  };
  window.staticToggleLogin = function () {
    if (readUser()) {
      localStorage.removeItem(storageKey);
      renderUser();
    } else if (window.openLoginModal) {
      window.openLoginModal();
    } else {
      signIn();
    }
  };
  function renderUser() {
    const user = readUser();
    document.querySelectorAll('button[onclick="window.staticToggleLogin()"], #openLoginMobile').forEach((button) => {
      if (button.matches('button')) button.textContent = user ? 'Hi, ' + user.name + ' · Sign out' : 'Sign in';
      else if (user) button.textContent = 'Sign out';
    });
  }
  document.addEventListener('click', (event) => {
    const mobileTrigger = event.target.closest('#openLoginMobile');
    if (mobileTrigger) {
      event.preventDefault();
      if (readUser()) {
        localStorage.removeItem(storageKey);
        renderUser();
      } else if (window.openLoginModal) {
        window.openLoginModal();
      } else {
        signIn();
      }
      return;
    }
    const button = event.target.closest('#googleLoginBtn, .login_btn');
    if (button) {
      event.preventDefault();
      signIn();
    }
  }, true);
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Enter' && event.target.matches('.mobile_login_box input')) {
      event.preventDefault();
      const phone = event.target.value.trim();
      if (phone) saveUser('Movie Fan', phone);
    }
  });
  document.addEventListener('DOMContentLoaded', () => {
    renderUser();
    const card = document.querySelector('.login_card');
    if (card && !card.querySelector('.static-login-note')) {
      const note = document.createElement('small');
      note.className = 'static-login-note';
      note.textContent = 'Demo sign-in is saved only in this browser.';
      note.style.cssText = 'display:block;text-align:center;margin:10px 0;color:#777;';
      card.appendChild(note);
    }
    document.querySelectorAll('.newsletter_form').forEach((form) => {
      const input = form.querySelector('input[type="email"]');
      const button = form.querySelector('button');
      if (button) button.addEventListener('click', () => {
        const email = input && input.value.trim();
        if (!email || !email.includes('@')) { alert('Enter a valid email address.'); return; }
        const subscribers = JSON.parse(localStorage.getItem('sairamMovieHubDemoSubscribers') || '[]');
        if (!subscribers.includes(email)) subscribers.push(email);
        localStorage.setItem('sairamMovieHubDemoSubscribers', JSON.stringify(subscribers));
        alert('Saved in this browser only. No subscription was sent to a server.');
        input.value = '';
      });
    });
  });
})();