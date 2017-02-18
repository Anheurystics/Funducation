<?php require('header.php'); ?>

        <div class="donatecontainer" style="align-items:center">

            <div style="display:flex; flex-direction: row;">
                <p id="donate">Donating to </p>
                <p id="donate" style="padding-left:10px">ADMU de Manila</p>
            </div>

            <form>

                <div style="display:flex; align-items:center; flex-direction:column">

                    <div>
                        <p style="text-align:center">Amount</p>
                        <textarea id="amount"></textarea>
                    </div>
                    <div>
                        <p>Mode of Payment</p>
                        <input type="radio" value"mode1"/>Bruh<br>
                        <input type="radio" value"mode2"/>Suh<br>
                    </div>
                    <a href="#"><div id="submit_button">Submit</div></a>
                    <a href="#"><div id="submit_button">Back</div></a>
                </div>
            </form>
        </div>

<?php require('footer.php');?>