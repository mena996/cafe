let items = document.getElementsByClassName('item');
let myOrder = document.getElementById('myOrder');
let orderArr = myOrder.children;
let bill = document.getElementById('bill');
for (const element of items) {
    element.addEventListener('click', (e) => {
        for (let i = 0; i < orderArr.length; i++) {
            let item = orderArr[i].firstChild.textContent;
            if(element.firstChild.textContent===item){
                return;
            }
        }
        let product = document.createElement('div');
        product.className = "productOptions";
        product.innerText = element.firstChild.textContent;
        let amount = document.createElement('span');
        ////////////////////////////////////
        let count = 1;
        amount.innerText=count;
        ///////////////////////////////////
        let total = document.createElement('span');
        let price = e.target.dataset["price"];
        total.className = "totalCost";
        total.innerText=count*price;
        ////////////////////////////////
        let incBtn = document.createElement('button');
        incBtn.className = "btn";
        incBtn.innerText="+";
        incBtn.addEventListener('click',()=>{ 
            count+=1; amount.innerText=count;
            total.innerText=count*price;
            calculateCost();
        })
        //////////////////////////////////
        let decBtn = document.createElement('button');
        decBtn.className = "btn";
        decBtn.innerText="-";
        decBtn.addEventListener('click',()=>{ 
            count-=1;
            if(count<1){count=1;} 
            amount.innerText=count;
            total.innerText=count*price;
            calculateCost();
        })
        ///////////////////////////////
        let removeBtn = document.createElement('button');
        removeBtn.className = "btn";
        removeBtn.innerText= "X";
        removeBtn.addEventListener('click',()=>{myOrder.removeChild(product); calculateCost(); })
        ///////////////////////////////
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
    for (let item of itemsPrice) {
        tot+=parseInt(item.innerText);
        bill.innerText=tot;
    }
}