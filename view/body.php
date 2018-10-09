<?php
/**
 * Created by PhpStorm.
 * User: caidi
 * Date: 9/10/18
 * Time: 5:18 PM
 */
echo "
<div class=\"container\" style=\"margin-left: 15% margin-right: 15%\">
    <div class=\"container text-center page-header\" style=\"margin-bottom: 20px\">
        <p class=\"h1\">Book Query System</p>
    </div>
    <div>
        <form name=\"display\" action=\"index.php\" method=\"POST\">
            <div class=\"form-group\">
                <input type=\"text\" class=\"form-control\" id=\"bookid\" name=\"bookid\" placeholder=\"Enter BookId\">
            </div>
            <div class=\"form-row align-items-left\">
                <div class=\"col-auto\">
                    <button type=\"submit\" name=\"searchById\" class=\"btn btn-primary\">Search</button>
                </div>
                <div class=\"col-auto\">
                    <button type=\"submit\" name=\"insert\" class=\"btn btn-success\">Add New</button>
                </div>
                <div class=\"col-auto\">
                    <button type=\"submit\" name=\"reset\" class=\"btn btn-danger\">Reset DB</button>
                </div>
            </div>

        </form>
    </div>
</div>
";