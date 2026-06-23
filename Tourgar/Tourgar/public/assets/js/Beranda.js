// ===== SLIDER =====
    const slides = document.querySelector('.slides');
    const slideImages = document.querySelectorAll('.slides img');
    let index = 0;
    const total = slideImages.length;

    function showSlide(n) {
      index = (n + total) % total;
    }

    document.getElementById('next').onclick = () => showSlide(index + 1);
    document.getElementById('prev').onclick = () => showSlide(index - 1);

    setInterval(() => showSlide(index + 1), 5000);

    // ===== FADE-IN SAAT SCROLL =====
    const fadeSections = document.querySelectorAll('.fade-section');
    window.addEventListener('scroll', () => {
      fadeSections.forEach(section => {
        const rect = section.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
          section.style.opacity = '1';
          section.style.transform = 'translateY(0)';
        }
      });
    });

function logout() {
  if (confirm("Logout dari akun TOUGAR?")) {
    localStorage.removeItem("loginTOUGAR");
    sessionStorage.clear();
    window.location.href = "../login/login.html";
  }
}

    
    // ===== SCROLL TO TOP =====
    const toTop = document.getElementById('toTop');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) toTop.style.display = 'block';
      else toTop.style.display = 'none';
    });
    toTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });