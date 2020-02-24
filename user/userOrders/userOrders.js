const cancelBtns =[... document.getElementsByClassName("cancelBtn")];
for (const btn of cancelBtns) {
    btn.addEventListener('click',(e)=>{
      // console.log("cancel");
      
      let orderId = e.target.dataset["id"];
      let requestData=`orderId=${orderId}`;
        
        fetch('/php_project/user/userOrders/cancelOrder.php', {
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
    fetch('/php_project/user/userOrders/showOrder.php', {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: requestData
    })
    .then(res=>res.json())
    .then(function (res) {
    const html = res.reduce((acc,product)=>`${acc}
      <h1>${product.product_id}</h1>
      `
    ,'<div>') + '</div>'
  
    })
    .catch(function (error) {
      console.log('Request failed', error);
    });
  })
}