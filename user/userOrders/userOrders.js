const cancelBtns =[... document.getElementsByClassName("cancelBtn")];
for (const btn of cancelBtns) {
    btn.addEventListener('click',(e)=>{
      // console.log("cancel");
      
      let orderId = e.target.dataset["id"];
      let requestData=`orderId=${orderId}`;
        
        fetch('cancelOrder.php', {
            method: 'post',
            headers: {
              "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: requestData
          })
          // .then((res)=>res.json())
          .then(function (res) {
            // console.log('Request succeeded with JSON response');
            alert("Your order is canceled!");
            location.reload();
          })
          .catch(function (error) {
            console.log('Request failed', error);
          });
    })
}

const showBtns =[... document.getElementsByClassName("showBtn")];

for (const btn of showBtns) {
  btn.addEventListener('click',(e)=>{
    // console.log("show");
    let orderId = e.target.dataset["id"];
    let requestData=`orderId=${orderId}`;
    fetch('showOrder.php', {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: requestData
    })
    .then(res=>res.json())
    .then(function (res) {
    const html = res.reduce((acc,product)=>`${acc}
      <div class="card" style="width:200px;height:250px">
      <img class="card-img-top" src='../../Images/${product.image}' style="height:150px">
      <div class="card-body">
        <h4 class="card-title">${product.name}</h4>
        <p class="card-text">Price: ${product.price} LE, Amount: ${product.amount}</p>
      </div>
    </div>`
    ,'');
    let orderSpecs = document.getElementById('orderSpecs');
    orderSpecs.innerHTML = html;
  
    })
    .catch(function (error) {
      console.log('Request failed', error);
    });
  })
}