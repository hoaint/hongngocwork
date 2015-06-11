<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/1/2015
 * Time: 5:09 PM
 */

//* Force full-width-content layout setting
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

add_action('genesis_meta', 'home_genesis_meta');
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function home_genesis_meta()
{
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'home_loop_helper');
}

/**
 * Display widget content for homepage sections.
 *
 */
function home_loop_helper()
{

    if (is_active_sidebar('news-carousel-section')) {
        echo '<div class="news-carousel-section">';
        dynamic_sidebar('news-carousel-section');
        echo '</div>';
    }

    if (is_active_sidebar('body-section')) {
        echo '<div class="body-section">';
        dynamic_sidebar('body-section');
        echo '</div>';
    } else {
        ?>
        <div id="demo">
            <div class="container">
                <div class="row">
                    <div class="span12">

                        <div class="owl-buttons">
                            <div class="owl-prev"><i class="icon-left-open"></i></div>
                            <div class="owl-next"><i class="icon-right-open"></i></div>
                        </div>

                        <div id="owl-demo" class="owl-carousel">

                            <div class="item"><h1>1</h1></div>
                            <div class="item"><h1>2</h1></div>
                            <div class="item"><h1>3</h1></div>
                            <div class="item"><h1>4</h1></div>
                            <div class="item"><h1>5</h1></div>
                            <div class="item"><h1>6</h1></div>
                            <div class="item"><h1>7</h1></div>
                            <div class="item"><h1>8</h1></div>
                            <div class="item"><h1>9</h1></div>
                            <div class="item"><h1>10</h1></div>
                            <div class="item"><h1>11</h1></div>
                            <div class="item"><h1>12</h1></div>
                            <div class="item"><h1>13</h1></div>
                            <div class="item"><h1>14</h1></div>
                            <div class="item"><h1>15</h1></div>
                            <div class="item"><h1>16</h1></div>

                        </div>


                    </div>
                </div>
            </div>

        </div>

    <?php
    }

}

genesis();