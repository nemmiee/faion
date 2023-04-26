<!-- Hiển thị thanh sản phẩm nổi bật -->
<div id="feature-product-container">
    <div class="title">SẢN PHẨM NỔI BẬT</div>
    <div class="slide-container">
        <?php displayFeature();?>
    </div>
    <div class="prev" onclick="plusSlide(-1)">
        <i class="fa-solid fa-angle-left fa-lg"></i>
    </div>
    <div class="next" onclick="plusSlide(1)">
        <i class="fa-solid fa-angle-right fa-lg"></i>
    </div>
</div>

<script>
    var slideProductsIndex = 1;
    showProductsSlides(slideProductsIndex);

    function plusSlide(n) {
        showProductsSlides(slideProductsIndex += n);
    }

    function showProductsSlides(n) {
        var i;
        var slides = document.querySelectorAll(".slide");
        if (n > slides.length)
            slideProductsIndex = 1;
        if (n < 1)
            slideProductsIndex = slides.length;
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideProductsIndex - 1].style.display = "flex";
    }
</script>

<?php
function displayFeature()
{
    $productList = getProductList();

    $count = 0;
    for ($i = 0; $i < count($productList); $i++) {
        if ($productList[$i]->getFeature() == 1) {
            ++$count;
            if ($count == 1) {
                echo "
                    <ul class=\"slide\">
                        <li class=\"card\">
                            <a href=\"/faion/index.php/products?info=" . $productList[$i]->getId() . "\">
                                <div class=\"container\">
                                    <div class=\"top\">
                                        <img src=\"" . $productList[$i]->getImage() . "\" alt=\"\">
                                    </div>
                                    <div class=\"bot\">" . $productList[$i]->getName() . "</div>
                                </div>
                            </a>
                        </li>";
            } else {
                echo "
                        <li class=\"card\">
                            <a href=\"/faion/index.php/products?info=" . $productList[$i]->getId() . "\">
                                <div class=\"container\">
                                    <div class=\"top\">
                                        <img src=\"" . $productList[$i]->getImage() . "\" alt=\"\">
                                    </div>
                                    <div class=\"bot\">" . $productList[$i]->getName() . "</div>
                                </div>
                            </a>
                        </li>";
            }
            if ($count == 5) {
                $count = 0;
                echo "</ul>";
            }
            if ($i == count($productList)) {
                echo "</ul>";
            }
        }
    }
}
?>