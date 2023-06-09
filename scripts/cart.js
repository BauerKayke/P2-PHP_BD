function cartUpdate() {
  const moviesOnCart = Object.entries(localStorage);
  let i = 0;
  moviesOnCart.forEach(([key, value]) => {
    if (value.includes('onCartFilm') || value.includes('onCartSerie')) {
      i++;
    }
  });

  if (i <= 9) {
    document.querySelector("#cart").dataset.count = i;
  } else {
    document.querySelector("#cart").dataset.count = "9+";
  }
  if (document.cookie.length == 0 && moviesOnCart.length != 0) {
    clearCart();
  }
}
function clearCart() {
  const cart = Object.entries(localStorage);
  let i = 0;
  // Itera sobre cada item utilizando forEach
  cart.forEach(([key, value]) => {
    localStorage.removeItem(key, value);
  });
}
function addToCart(id, type) {
  let onCartType;
  if (type == 0) {
    onCartType = "onCartFilm";
  } else {
    onCartType = "onCartSerie";
  }
  localStorage.setItem(id, onCartType);
  document.cookie = id + `=${onCartType};path=/`;

  const btnAdd = document.querySelector(`#add${id}${type}`);
  const btnRemove = document.querySelector(`#remove${id}${type}`);

  btnAdd.classList.add("hide");
  btnRemove.classList.remove("hide");

  cartUpdate();
}
function removeFromCart(id, type) {
  if (id != undefined) {
    if (type == 0) {
      localStorage.removeItem(id, "onCartFilm");
    } else {
      localStorage.removeItem(id, "onCartSerie");
    }
    document.cookie = id + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/";

    const btnAdd = document.querySelector(`#add${id}${type}`);
    const btnRemove = document.querySelector(`#remove${id}${type}`);

    btnAdd.classList.remove("hide");
    btnRemove.classList.add("hide");

    cartUpdate();
  } else if (itemId != null && detailId == null) {
    localStorage.removeItem(itemId, "");
    document.cookie =
      itemId + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/";
    location.reload();
  }
}
