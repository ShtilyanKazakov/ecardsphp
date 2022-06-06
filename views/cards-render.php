<section class="features" id="features" style="width: 50%;margin: 5% auto;text-align: center;"></section>

<script type="text/javascript">
    // Rendeing throught Dom the Features section
    const features_section = document.querySelector('.features');
    const row_child = document.createElement('div');
    row_child.classList.add('row');
    features_section.appendChild(row_child);

    const features_object = [
        {
            src: '../views/cards/image_1.jpg',
            title: 'Easily Customised'
        },
        {
            src: '../views/cards/image_2.jpg',
            title: 'Responsive Design'
        },
        {
            src: '../views/cards/image_3.jpg',
            title: 'Modern Design'
        },
        {
            src: 'https://source.unsplash.com/random/200x200/',
            title: 'Clean Code'
        },
    ];
    function featuresContent(src, title, accessButton) {
        return row_child.innerHTML += `
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" width="200px" height="200px" src="${src}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">${title}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
<!--            <a href="#" class="btn btn-primary">Go somewhere</a>-->
            ${accessButton}
        </div>
    </div>
    `;
    }
</script>

<?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) { ?>
<script type="text/javascript">

    for (const key in Object.entries(features_object)) {
    featuresContent(features_object[key].src, features_object[key].title, `<a href="#" class="btn btn-primary">Go somewhere</a>`);
    }
    </script>

<?php }  else {?>
<script type="text/javascript">

    for (const key in Object.entries(features_object)) {
    featuresContent(features_object[key].src, features_object[key].title, '');
    }
</script>
<?php
}
?>
