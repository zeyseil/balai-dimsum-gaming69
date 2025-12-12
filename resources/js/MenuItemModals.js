/**
 * MenuItemModal - Vanilla JavaScript modal component
 * Handles menu item selection, size selection, quantity, and notes
 */

class MenuItemModal {
  constructor(options = {}) {
    this.state = {
      item: null,
      size: 'Reguler',
      quantity: 1,
      notes: '',
      isOpen: false,
      existingOrder: null
    };

    this.onAddToOrder = options.onAddToOrder || (() => {});
    this.onClose = options.onClose || (() => {});

    this.modalElement = null;
    this.init();
  }

  init() {
    this.createModal();
  }

  createModal() {
    this.modalElement = document.createElement('div');
    this.modalElement.id = 'menu-item-modal';
    this.modalElement.className = 'hidden';
    this.modalElement.innerHTML = `
      <div class="modal-overlay">
        <div>
          <!-- Header -->
          <div>
            <button class="modal-close-back" title="Kembali">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>

            <button class="modal-close-x" title="Tutup">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>

            <img
              id="modal-item-image"
              src=""
              alt=""
            />
          </div>

          <!-- Content -->
          <div style="padding-left: 1rem; padding-right: 1rem; padding-bottom: 2rem;">
            <h2 id="modal-item-name" style="font-family: 'Jua', sans-serif">
            </h2>

            <p id="modal-item-price" style="font-family: 'Jua', sans-serif">
            </p>

            <!-- Size Selection -->
            <div style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem;">
              <button class="size-btn" data-size="Reguler" style="font-family: 'Jua', sans-serif">
                Reguler
              </button>
              <button class="size-btn" data-size="Mini" style="font-family: 'Jua', sans-serif">
                Mini
              </button>
            </div>

            <!-- Notes -->
            <div style="margin-bottom: 1.5rem;">
              <label style="display: block; color: white; font-size: 20px; font-weight: normal; margin-bottom: 0.75rem; font-family: 'Jua', sans-serif;">
                Notes :
              </label>
              <textarea
                id="modal-notes"
                placeholder="Input Box"
                style="font-family: 'Jua', sans-serif"
              ></textarea>
            </div>

            <!-- Dimsum tagline -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-left: 0.5rem; padding-right: 0.5rem;">
              <img
                src="https://api.builder.io/api/v1/image/assets/TEMP/26058cf8936b03e3c66fc155391130a7e482f865?width=472"
                alt=""
                style="width: 40px; height: 35px;"
              />
              <p style="color: white; font-size: 14px; font-weight: normal; text-align: center; flex: 1; margin: 0 0.75rem; font-family: 'Jua', sans-serif;">
                Dimsumkeun, let's try our signature mentai!
              </p>
              <img
                src="https://api.builder.io/api/v1/image/assets/TEMP/0e36c430bc8080e28748e5e7e5eecf6aab7f3f77?width=434"
                alt=""
                style="width: 40px; height: 39px;"
              />
            </div>

            <!-- Background section -->
            <div class="modal-background-section">
              <!-- Quantity -->
              <div class="quantity-container">
                <label class="quantity-label" style="font-family: 'Jua', sans-serif;">
                  Total Order :
                </label>
                <div class="quantity-controls">
                  <button class="quantity-btn-minus" title="Kurangi">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                  </button>
                  <span id="modal-quantity" style="font-family: 'Jua', sans-serif;">
                    1
                  </span>
                  <button class="quantity-btn-plus" title="Tambah">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Add Button -->
              <button class="modal-submit-btn" style="font-family: 'Jua', sans-serif;">
                Tambahkan
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

    document.body.appendChild(this.modalElement);
    this.attachEventListeners();
  }

  attachEventListeners() {
    // Close buttons
    this.modalElement.querySelector('.modal-close-back')?.addEventListener('click', () => this.close());
    this.modalElement.querySelector('.modal-close-x')?.addEventListener('click', () => this.close());

    // Overlay close
    this.modalElement.querySelector('.modal-overlay')?.addEventListener('click', (e) => {
      if (e.target.classList.contains('modal-overlay')) {
        this.close();
      }
    });

    // Size buttons
    this.modalElement.querySelectorAll('.size-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        this.setState({ size: e.target.dataset.size });
        this.updateSizeButtons();
      });
    });

    // Quantity buttons
    this.modalElement.querySelector('.quantity-btn-minus')?.addEventListener('click', () => {
      this.setState({ quantity: Math.max(1, this.state.quantity - 1) });
      this.updateQuantityDisplay();
    });

    this.modalElement.querySelector('.quantity-btn-plus')?.addEventListener('click', () => {
      this.setState({ quantity: this.state.quantity + 1 });
      this.updateQuantityDisplay();
    });

    // Notes textarea
    this.modalElement.querySelector('#modal-notes')?.addEventListener('change', (e) => {
      this.setState({ notes: e.target.value });
    });

    // Submit button
    this.modalElement.querySelector('.modal-submit-btn')?.addEventListener('click', () => {
      this.handleSubmit();
    });
  }

  setState(newState) {
    this.state = { ...this.state, ...newState };
  }

  updateSizeButtons() {
    this.modalElement.querySelectorAll('.size-btn').forEach(btn => {
      if (btn.dataset.size === this.state.size) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });
  }

  updateQuantityDisplay() {
    const quantityEl = this.modalElement.querySelector('#modal-quantity');
    if (quantityEl) {
      quantityEl.textContent = this.state.quantity;
    }
  }

  open(item, existingOrder = null) {
    this.setState({
      item,
      isOpen: true,
      existingOrder
    });

    if (existingOrder) {
      this.setState({
        size: existingOrder.size,
        quantity: existingOrder.quantity,
        notes: existingOrder.notes
      });
    } else {
      this.setState({
        size: 'Reguler',
        quantity: 1,
        notes: ''
      });
    }

    this.render();
  }

  close() {
    this.setState({ isOpen: false });
    this.modalElement.classList.add('hidden');
    this.onClose();
  }

  render() {
    if (!this.state.item) return;

    const item = this.state.item;

    // Update item information
    const imageEl = this.modalElement.querySelector('#modal-item-image');
    if (imageEl) imageEl.src = item.image;

    const nameEl = this.modalElement.querySelector('#modal-item-name');
    if (nameEl) nameEl.textContent = `Dimsum ${item.name} isi 5`;

    const priceEl = this.modalElement.querySelector('#modal-item-price');
    if (priceEl) priceEl.textContent = `Rp : ${item.price.toLocaleString('id-ID')}`;

    const notesEl = this.modalElement.querySelector('#modal-notes');
    if (notesEl) notesEl.value = this.state.notes;

    // Update size buttons
    this.updateSizeButtons();

    // Update quantity
    this.updateQuantityDisplay();

    // Show modal
    this.modalElement.classList.remove('hidden');
  }

  handleSubmit() {
    const item = this.state.item;
    if (!item) return;

    const orderItem = {
      id: this.state.existingOrder?.id || `${item.id}-${Date.now()}`,
      menuItem: item,
      size: this.state.size,
      quantity: this.state.quantity,
      notes: this.state.notes
    };

    this.onAddToOrder(orderItem);
    this.close();
  }
}

// Export for use in Blade
window.MenuItemModal = MenuItemModal;