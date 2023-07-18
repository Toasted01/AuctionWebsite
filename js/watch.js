function W(){//shows the winning text for if the user is winning the auction
    let status = document.getElementById('status');
    status.innerHTML = '<p id="W">Winning</p> <style> #W {text-align: center; font-size: 60px; margin-top: 0px; color: green;}</style>';
}

function L(){//shows the outbidded text for if the user is not winning the auction
    let status = document.getElementById('status');
    status.innerHTML = '<p id="L">Outbid</p> <style> #L {text-align: center; font-size: 60px; margin-top: 0px; color: red;}</style>';
}