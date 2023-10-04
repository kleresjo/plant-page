<?php // http://localhost:8888/

require_once __DIR__ . "/classes/Template.php";


Template::header("");
?>

<div class="hero">
    <div class="hero-text">
        <h1 class="hero-title">Welcome to your virtual plant diary</h1>
        <p class="hero-p">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus, quisquam?
        </p>
        <button class="callout-btn">LOREM</button>
    </div>
</div>

<h2 class="title">Popular plants</h2>

<div class="API-div">

</div>

<!-- this code fetches my API -->

<script>
    fetch('./products.json')

        .then(res => {
            return res.json();
        })

        .then(jsondata => {
            jsondata.forEach(product => {
                const productLine = `<div class="api-card">
            <img class="api-image" src="${product.productImg}"></img>
            <div class="api-content">
            <div class="api-text">
            <h3 class="api-title">${product.productName}</h3>
            <p class="api-diff">${product.productDiff}</p>
            </div>
            <div class="like-list">
            <button class="like-btn"><i class="fa-solid fa-heart"></i></button>
            </div>
            </div>
            </div>`
                document.querySelector('.API-div').insertAdjacentHTML('beforeend', productLine);
            });
        })

        .catch(error => console.log(error));
</script>

<?php
Template::footer();
