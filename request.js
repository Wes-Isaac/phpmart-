
 async function  fetchData(){

const a= await axios.get('item_json.php');

 
    
 if(a) {
     
     return a.data;
 } else{
     return [];
 }
}
// const g= async function(hi) {
    // let t =await hi;
    
    // console.log(t);
    // return t;
// }
  



//     fetchData().then((res) => {

//     const data =  res.data;
   
//     console.log("hello");
//     console.log(data);
//     let output = '';
//     for(let i in data) {
//         output +=`<div>
//         <a href="item.php?id=${data[i].id}"> <h2>Item: ${data[i].item_name}</h2></a>
//         <img src="./uploads/${data[i].image_name}" alt="NO IMAGE">
      


//         <P>Description: ${data[i].description}</p>

//         <p>Price: ${data[i].price}</p>
//         <p>Quantity: ${data[i].quantity}</p>
//         </div>`;
//     }
//      const item =document.querySelector('#item');
//      if(item) {

//          item.innerHTML = output;

        
         
        
       
//      }
   
    
// });

     






// const butt = document.querySelector('#show');
// const pagination = document.querySelector('.pagination');
// const listElement = document.querySelector('.list');
// let current_page = 1;
// let rows = 3;

function displayList(items, wrapper,rows_per_page,page){
    console.log('displayList');
    wrapper.innerHTML = "";
    page--;
    let start = rows_per_page * page;
    let end = start + rows_per_page;
    let pagItems= items.slice(start, end);
    
    
    for(let i =0; i< pagItems.length; i++) {
        console.log(pagItems[i]);
        let item = pagItems[i];
        let itemEle = document.createElement('div');
        itemEle.innerText =item.item_name;

        wrapper.appendChild(itemEle);


    }
}

function paginate (items,wrapper,rows_per_page){

    wrapper.innerHTML= "";

    let pageCount = Math.ceil(items.length/rows_per_page);

    for(let i =1; i<pageCount+1; i++){
       let btn = paginationButton(i,items);
       wrapper.appendChild(btn);
    }
}

function paginationButton(page, items) {
    let button = document.createElement('button');
    button.innerText = page;
    current_page = page;
    button.addEventListener('click', () => {
        console.log('BUTTON CLICKED');
    })

    return button;
}
 



// if(butt) {
//     butt.addEventListener('click', r);
    
    
    
// }


    //   displayList(g(r()),listElement,rows,current_page);
    //   paginate(g(r()),pagination,rows);






// const plus = document.querySelector('.plus');
// const qty = document.querySelector('.qty');
// const price = document.querySelector('.price');


// plus.addEventListener('click', () => {
   
   
//    inputVal = Number(qty.value);
//    if(inputVal < 10) {
//    qty.value = Number(qty.value)+ 1;
//    console.log(qty.value);
//    }
// });


// const minus = document.querySelector('.minus');

// minus.addEventListener('click', () => {
   
//     inputVal = Number(qty.value);
//    if(inputVal >= 1) {
//     qty.value = Number(qty.value) - 1;
//     console.log(qty.value);
//    }
//  });


//  const add = document.querySelector('.add');


//  add.addEventListener('click', () => {
     
//     const cart = document.querySelector('#cart');

//     cart.innerHTML = `<h1>${qty.value} </h1>
//                        <p>${price.innerText}<p>
//                         <h2>${Number(qty.value) * Number(price.innerText)}`



//  });

 