import React, { useState, useEffect } from 'react';

export const menuItems = [
  {
    id: 'nori',
    name: 'Nori',
    image: './img/Dimsumdisplay6.png',
    price: 12000,
    category: 'nori'
  },
  {
    id: 'keju',
    name: 'Keju',
    image: './img/Dimsumdisplay3.png',
    price: 12000,
    category: 'keju'
  },
  {
    id: 'mentai',
    name: 'Mentai',
    image: './img/Dimsumdisplay1.png',
    price: 12000,
    category: 'mentai'
  },
  {
    id: 'mix',
    name: 'Mix',
    image: './img/Dimsumdisplay2.png',
    price: 12000,
    category: 'mix'
  }
];

export default function MenuItemModal({
  item,
  isOpen,
  onClose,
  onAddToOrder,
  existingOrder
}) {
  const [size, setSize] = useState('Reguler');
  const [quantity, setQuantity] = useState(1);
  const [notes, setNotes] = useState('');

  useEffect(() => {
    if (existingOrder) {
      setSize(existingOrder.size);
      setQuantity(existingOrder.quantity);
      setNotes(existingOrder.notes);
    } else {
      setSize('Reguler');
      setQuantity(1);
      setNotes('');
    }
  }, [existingOrder, isOpen]);

  if (!isOpen || !item) return null;

  const handleSubmit = () => {
    const orderItem = {
      id: existingOrder?.id || `${item.id}-${Date.now()}`,
      menuItem: item,
      size,
      quantity,
      notes
    };
    onAddToOrder(orderItem);
    onClose();
  };

  const incrementQuantity = () => setQuantity(prev => prev + 1);
  const decrementQuantity = () => setQuantity(prev => Math.max(1, prev - 1));

  // The rest of the component JSX should be here
}

  return (
    <link rel="stylesheet" href="{{ asset('style1.css') }}"></link>
    <div class="container">
          <div class="top-bar">
            <button class="back-btn" onclick="{onClose}">&#8592;</button>
            <span class="title">Menu Info</span>
          </div>
          <div class="image-box">
            <img src="{item.image}" alt="{item.name}" />
          </div>
          <div class="content"></div>
          <h2 class="menu-name">Dimsum {item.name} isi 5</h2>
      <p class="price">Rp : {item.price.toLocaleString('id-ID')}</p>

      <div class="option-row">
        <button class="opt-btn active" onclick={() => setSize('Reguler')}>Reguler</button>
        <button class="opt-btn" onclick={() => setSize('Mini')}>Mini</button>
      </div>

      <label class="notes-label">Notes :</label>
      <textarea class="notes-box" placeholder="Catatan tambahan." value={notes}
      onChange={(e) => setNotes(e.target.value)}></textarea>

      <div class="promo">
        <img src="img/dimsum2.png" class="promo-icon">
        <span>Dimsumkeun, let’s try our signature mentai!</span>
        <img src="img/dimsum4.png" class="promo-icon">
      </div>

      <div class="order-row">
        <span>Total Order :</span>
        <div class="qty">
          <button class="qty-btn" onclick={decrementQuantity}>−</button>
          <span class="qty-num">1</span>
          <button class="qty-btn" onclick={incrementQuantity}>+</button>
        </div>
      </div>
      <button class="tambah-btn" onclick={handleSubmit}>Tambahkan</button>
    </div>
    <footer class="footer">footer</footer>
    <div class="copyright">
      Copyright 2025. All rights reserved.
    </div>
  </div>
  );
}
