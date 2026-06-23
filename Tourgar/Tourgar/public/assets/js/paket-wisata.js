  const cards = document.querySelectorAll('.paket-card');
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); });
    }, { threshold: 0.18 });
    cards.forEach(c => io.observe(c));

    const modal = document.getElementById('modal');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const modalClose = document.getElementById('modalClose');
    const modalContent = document.getElementById('modalContent');

    function showDetailModal(packageId) {
      const pkg = packagesData[packageId];
      if (!pkg) return;

      const html = `
        <div class="modal-header">
          <h2>${pkg.title}</h2>
        </div>
        <div class="modal-body">
          <div class="detail-packages">
            ${pkg.subPackages.map(sub => `
              <div class="detail-item">
                <img src="${sub.img}" alt="${sub.name}">
                <div class="detail-info">
                  <h4>${sub.name}</h4>
                  <p>${sub.desc}</p>
                  <span class="detail-price">Rp ${sub.price.toLocaleString('id-ID')}</span>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;

      modalContent.innerHTML = html;
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    // Show booking modal
    function showBookingModal(packageId) {
      const pkg = packagesData[packageId];
      if (!pkg) return;

      const html = `
        <div class="modal-header">
          <h2>Booking ${pkg.title}</h2>
        </div>
        <div class="modal-body">
          <div class="booking-section">
            <div>
              <img src="${pkg.img}" alt="${pkg.title}" class="booking-img">
            </div>
            <form class="booking-form" id="bookingForm">
              <label>
                Nama Lengkap *
                <input type="text" id="bkName" required>
              </label>
              <label>
                Email *
                <input type="email" id="bkEmail" required>
              </label>
              <label>
                No. Telepon *
                <input type="tel" id="bkPhone" required>
              </label>
              <label>
                Pilih Paket *
                <select id="bkPackage" required>
                  ${pkg.subPackages.map((sub, idx) => `
                    <option value="${idx}" data-price="${sub.price}">
                      ${sub.name} - Rp ${sub.price.toLocaleString('id-ID')}
                    </option>
                  `).join('')}
                </select>
              </label>
              <label>
                Tanggal Keberangkatan *
                <input type="date" id="bkDate" required>
              </label>
              <label>
                Jumlah Peserta
                <input type="number" id="bkQty" min="1" value="1" required>
              </label>
              <div class="form-foot">
                <button type="submit" class="btn-submit">Konfirmasi Booking</button>
                <button type="button" class="btn-cancel" id="btnCancel">Batal</button>
              </div>
              <div class="booking-message" id="bookingMessage"></div>
            </form>
          </div>
        </div>
      `;

      modalContent.innerHTML = html;
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      // Setup form handler
      setupBookingForm(packageId, pkg);
    }

    // Setup booking form
    function setupBookingForm(packageId, pkg) {
      const form = document.getElementById('bookingForm');
      const message = document.getElementById('bookingMessage');
      const cancelBtn = document.getElementById('btnCancel');

      cancelBtn.addEventListener('click', closeModal);

      form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const name = document.getElementById('bkName').value.trim();
        const email = document.getElementById('bkEmail').value.trim();
        const phone = document.getElementById('bkPhone').value.trim();
        const packageSelect = document.getElementById('bkPackage');
        const packageIdx = parseInt(packageSelect.value);
        const selectedPackage = pkg.subPackages[packageIdx];
        const date = document.getElementById('bkDate').value;
        const qty = parseInt(document.getElementById('bkQty').value) || 1;

        const total = selectedPackage.price * qty;

        const booking = {
          id: 'bk_' + Date.now(),
          packageId: packageId,
          packageTitle: pkg.title,
          subPackage: selectedPackage.name,
          name, email, phone, date, qty,
          unitPrice: selectedPackage.price,
          total,
          createdAt: new Date().toISOString()
        };

        const bookings = JSON.parse(localStorage.getItem('garut_bookings') || '[]');
        bookings.push(booking);
        localStorage.setItem('garut_bookings', JSON.stringify(bookings));

        message.innerHTML = `
          Terima kasih, <strong>${name}</strong>!<br>
          Booking ${selectedPackage.name} berhasil tersimpan.<br>
          Total: <strong>Rp ${total.toLocaleString('id-ID')}</strong><br>
          Kami akan menghubungi Anda via ${email} / ${phone}.
        `;
        message.classList.add('show');

        setTimeout(() => {
          closeModal();
        }, 3000);
      });
    }

    function closeModal() {
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    modalClose.addEventListener('click', closeModal);
    modalBackdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => { 
      if (e.key === 'Escape') closeModal(); 
    });

    document.getElementById('paketContainer').addEventListener('click', (ev) => {
      const btn = ev.target.closest('button');
      if (!btn) return;

      const action = btn.dataset.action;
      const card = btn.closest('.paket-card');
      if (!card) return;

      const packageId = card.dataset.id;

      if (action === 'detail') {
        showDetailModal(packageId);
      } else if (action === 'pesan') {
        showBookingModal(packageId);
      }
    });

    window.getBookings = function() {
      return JSON.parse(localStorage.getItem('garut_bookings') || '[]');
    };