let items = [... document.getElementsByClassName('image')];
let myOrder = document.getElementById('myOrder');
let orderArr = myOrder.children;
let bill = document.getElementById('bill');


for (const element of items) {
    
    element.addEventListener('click', (e) => {
        
        let product_id = e.target.dataset["id"];
        let price = e.target.dataset["price"];
        
        for (let i = 0; i < orderArr.length; i++) {
            let item = orderArr[i].firstChild.innerText;
            if(item === e.target.dataset["name"]){
                return;
            }
        }
        
        let product = document.createElement('div');
        
        product.className = "productOptions";
        // product.innerText = element.firstChild.textContent;
        
        let name = document.createElement('span')
        // name.name = "name[]";
        // name.className = "productName";
        name.innerText = e.target.dataset["name"];
        ////////////////////////////////////
        let amount = document.createElement('input');
        amount.name=`products[${product_id}]`;
        amount.className="amount";
        let count = 1;
        amount.value=count;
        ///////////////////////////////////
        let total = document.createElement('span');
        total.className = "totalCost";
        total.innerText=count*price;
        ////////////////////////////////
        let incBtn = document.createElement('button');
        incBtn.type="button";
        incBtn.className = "btn";
        incBtn.innerText="+";
        incBtn.addEventListener('click',()=>{ 
            count+=1; amount.value=count;
            total.innerText=count*price;
            calculateCost();
        })
        //////////////////////////////////
        let decBtn = document.createElement('button');
        decBtn.type="button";
        decBtn.className = "btn";
        decBtn.innerText="-";
        decBtn.addEventListener('click',()=>{ 
            count-=1;
            if(count<1){count=1;} 
            amount.value=count;
            total.innerText=count*price;
            calculateCost();
        })
        ///////////////////////////////
        let removeBtn = document.createElement('button');
        removeBtn.type="button";
        removeBtn.className = "btn";
        removeBtn.innerText= "X";
        removeBtn.addEventListener('click',()=>{myOrder.removeChild(product); calculateCost(); })
        ///////////////////////////////
        product.appendChild(name);
        product.appendChild(incBtn);
        product.appendChild(amount);
        product.appendChild(decBtn);
        product.appendChild(total);
        product.appendChild(removeBtn);
        myOrder.appendChild(product);
        calculateCost();
        
    })
}

function calculateCost(){
    let tot=0;
    let itemsPrice = [... document.getElementsByClassName('totalCost')];
    if(itemsPrice.length===0){
        bill.innerText="";
    }
    for (let item of itemsPrice) {
        tot+=parseInt(item.innerText);
        bill.innerText=tot+" LE";
    }
}



const fd = document.getElementById('order-form')
fd.addEventListener('submit',(e)=>{
    e.preventDefault()
    let requestData=''
    const formData = new FormData(document.getElementById('order-form'))

    for (const [name,value] of formData.entries()){ 
        requestData+=`${name}=${value}&`
    }
    if(myOrder.innerHTML===""){
        alert("Please choose a product");
        return;
    }
    fetch('confirmOrder.php', {
        method: 'post',
        headers: {
          "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: requestData
      })
    //   .then(json)
      .then(function (data) {
        console.log('Request succeeded with JSON response', data);
        alert("Thank you! Your order was successfully submitted!");
        location.reload();
      })
      .catch(function (error) {
        console.log('Request failed', error);
      });
        
})