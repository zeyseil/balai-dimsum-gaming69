@extends('.menu')

@section('content')
<link rel="stylesheet" href="style1.css">

<div class="container">
<div class="top-bar">
  <button class="back-btn" onclick="sembunyikanDialog()">&#8592;</button>
  <span class="title">Menu Info</span>
</div>

<div class="image-box">
  <img src="{{ $item->image }}" alt="{item.name}" />
</div>

<div class="content">

  <h2 class="menu-name">Dimsum {{ $item->name }} isi 5</h2>
  <p class="price">Rp :</p>

  <div class="option-row">
    <button class="opt-btn">Reguler</button>
    <button class="opt-btn" >Mini</button>
  </div>

  <label class="notes-label">Notes :</label>
  <textarea class="notes-box" id="pesanan-notes" placeholder="Catatan tambahan."></textarea>

  <div class="promo">
    <img src="img/dimsum2.png" class="promo-icon">
    <span>Dimsumkeun, let’s try our signature mentai!</span>
    <img src="img/dimsum4.png" class="promo-icon">
  </div>

  <div class="order-row">
    <span>Total Order :</span>
    <div class="qty">
      <button class="qty-btn">−</button>
      <span class="qty-num">1</span>
      <button class="qty-btn">+</button>
    </div>
  </div>
  <button class="tambah-btn">Tambahkan</button>
@endsection