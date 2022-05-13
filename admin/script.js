
if (document.readyState == 'loading') {
  document.addEventListener('DOMContentLoaded', ready)
} else {
  ready()
} 
function ready(){

  let addToCartButtons = document.getElementsByClassName('incart');
  for (let i = 0; i < addToCartButtons.length; i++) {
      let button = addToCartButtons[i];
      console.log(button);
      button.addEventListener('click', addToCartClicked)
  }

}














async function display() {
  const response = await fetchData();
  console.log(response);

  const item = document.querySelector("#item");
  if (item) {
  
    displayList(response, listElement, rows, current_page);
    paginate(response, pagination, rows);
  } else {
    console.log("CANT FIND DOM ELEMENT!!!");
  }
}

const pagination = document.querySelector(".pagination");
const listElement = document.querySelector(".list");
let current_page = 1;
let rows = 2;

function displayList(items, wrapper, rows_per_page, page) {
  console.log("displayList");
  wrapper.innerHTML = "";
  page--;
  let start = rows_per_page * page;
  let end = start + rows_per_page;
  let pagItems = items.slice(start, end);
  const item_name = [];
  const price = [];

  for (let i = 0; i < pagItems.length; i++) {
    console.log(pagItems[i]);
    let item = pagItems[i];
    let itemEle = document.createElement("div");
    itemEle.classList.add('item-grid');
   

    itemEle.innerHTML = `<div class="item-flex" >
    
    <img class="responsive"  src="../uploads/${item.image_name}" alt="NO IMAGE">
    <div>
    <h2><a href="item.php?id=${item.id}">Item: ${item.item_name}</a></h2>


        <p >Description: ${item.description}</p>
        <p id="price"> ${item.price}</p>
        <p>Quantity: ${item.quantity}</p>
        <button class="btn btn-primary incart" id="addcart">add to cart</button>
        </div>
        </div>`;

    item_name.push(item.item_name);
    price.push(item.price);

    wrapper.appendChild(itemEle);
  }



  const addcart = document.querySelectorAll("#addcart");
  console.log(addcart);

  cart(addcart, item_name, price);



}



function removeCartItem(event){
  let buttonClicked = event.target;
  console.log(buttonClicked.parentElement.parentElement.remove());
  updateCartTotal();
}


function quantityChanged(event) {
  var input = event.target
  if (isNaN(input.value) || input.value <= 0) {
      input.value = 1
  }
  updateCartTotal()
}




function cart(addcart, itemname, price) {
  console.log(addcart.length);

  const div = document.querySelector("#form");

  addcart.forEach((val,index) => {
    val.addEventListener('click',()=>{

    
      addToCartClicked(itemname[index],price[index],index);
      console.log(itemname);
    })
  })
  
}



function addToCartClicked(name,price,index)  {
   
    addItemToCart(name,price,index);
    updateCartTotal();
    

}

function addItemToCart(name, price,i) {
    let cartRow =document.createElement('div');
    console.log(name);
   

    let cart = document.querySelector('#form');
    cart.classList.remove('form-display');
    cartItems = document.getElementsByClassName('cart-items')[0];

    let cartItemNames = cartItems.getElementsByClassName('label-name');

    for(let i=0; i<cartItemNames.length; i++) {

      if(cartItemNames[i].innerText == name) {
        alert('This item is already added to the cart');
        return;
      }
    }

    console.log(cartItemNames)
    console.log(cartItems);

    console.log(cart);
    let cartRowContent = `<div class= "cart-item item-flex-form">
    <label class="label-name" for="${name}" id="item-name" name="${name}">${name}</label>

    <span class="cart-price cart-column">${price}</span>
    
    <input type="number" name="${name}" id="${name}" value="1" class="quantity responsive" >
    
    <button  class="btn btn-danger remove" type="button">REMOVE</button>
    </div>`;

    cartRow.innerHTML =cartRowContent;
    
    cartRow.classList.add('item-grid');

    cartItems.appendChild(cartRow);
    cartRow.getElementsByClassName('remove')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('quantity')[0].addEventListener('change', quantityChanged)

  }

    function updateCartTotal() {
      
    const form = document.querySelector("#form");
    const cartItems = form.getElementsByClassName("cart-item");
    console.log(cartItems);
    let total= 0;
    for (let i = 0; i < cartItems.length; i++) {
      let cartItem = cartItems[i];
      console.log(cartItem);
      let price = cartItem.children[1].innerText;
      let quantity = cartItem.children[2].value;
      console.log(price);
      console.log(quantity);
      console.log(price * quantity);
      total += price * quantity;
    }
  console.log(total);
    document.querySelector("#total").value = total;
    }




function removeItem(event) {

  let e=event.target.parentElement;


  
  
  console.log(e.parentElement);
  e.parentElement.remove();
  console.log(this.parentElement);
  this.parentElement.remove();
  updateCartTotal();
  i++;
  
}

function updateQuantity(event) {
  let input = event.target;

  if (isNaN(input.value) || input.value <= 0) {
    input.value = 1;
  }
  updateCartTotal();
}

function removedFromCart(item, arr=[]) {

  arr.push(item);

  return arr;

 

}


function paginate(items, wrapper, rows_per_page) {
  wrapper.innerHTML = "";

  let pageCount = Math.ceil(items.length / rows_per_page);

  for (let i = 1; i < pageCount + 1; i++) {
    let btn = paginationButton(i, items);
    btn.classList.add('page-link');
    // btn.classList.remove('is-current');
    
    wrapper.appendChild(btn);
  }
}



function paginationButton(page, items) {
  let button = document.createElement("a");
  button.innerText = page;
  
  button.addEventListener("click", () => {
     
    console.log("BUTTON CLICKED");
    current_page = page;
    displayList(items, listElement, rows, current_page);
  });
  
  return button;
}


display();



