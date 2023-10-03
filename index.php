<?php // http://localhost:8888/

require_once __DIR__ . "/classes/Template.php";


Template::header("");
?>

<div>
    <h2> About Plant page </h2>
    <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed sapiente repellat accusamus doloribus laborum minus. Tempore, aliquid sunt? Doloremque pariatur a sint perspiciatis omnis vel repellat? Beatae architecto id nam perspiciatis consectetur debitis optio rem magnam nostrum inventore itaque voluptates illum voluptatum sequi sed dignissimos, unde veritatis minus delectus quibusdam?
    </p>
</div>
<h2>Popular products</h2>

<div class="API-div">

</div>

<!-- kod för att hämta produkter från mitt API -->

<script>
    fetch('./products.json')

        .then(res => {
            return res.json();
        })

        .then(jsondata => {
            jsondata.forEach(product => {
                const productLine = `<div class="produkt-card"><img id="produkt-image" src="${product.productImg}"></img>
            <p class="produkt-titel">${product.productName}</p>
            <p class="produkt-diff">${product.productDiff}</p>
            </div>`
                document.querySelector('.API-div').insertAdjacentHTML('beforeend', productLine);
            });
        })

        .catch(error => console.log(error));
</script>

<?php
Template::footer();
