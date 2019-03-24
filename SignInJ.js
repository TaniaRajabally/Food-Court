nonmod = document.getElementById('login-form');
part = document.getElementsByClassName('particle');
mod = document.getElementById('CreateModal');
para = document.getElementById('p2');

para.onclick= function () {
    for (i=0;i<part.length;i++)
        part[i].style.display='none';

    mod.style.display='block';
    // nonmod.style.display='none';

    lInput = document.getElementsByClassName('input1');
    for (i=0; i<lInput.length ;i++)
        lInput[i].toggleAttribute('disabled');

    para.disabled=true

};


mod.onmouseover = function () {

    mod.style.border='1px white solid';
    mod.style.background='rgba(5,5,5,0.3)'
};

mod.onmouseout = function () {
    mod.style.border='1px solid gray';
    mod.style.background='rgba(5,5,5,0.1)'
};


cancel = document.getElementById('cancelbtn');

cancel.onclick = function () {
    mod.style.display='none';
    for (i = 0; i<part.length;i++)
        part[i].style.display='block';

    lInput = document.getElementsByClassName('input1');
    for (i=0; i<lInput.length ;i++)
        lInput[i].toggleAttribute('disabled');

    para.disabled=false
};

createACC = document.getElementById('signupbtn');
createACC.onclick =function () {
    alert('New Account Created');
    mod.style.display='none';
    for (i = 0; i<part.length;i++)
        part[i].style.display='block';

    lInput = document.getElementsByClassName('input1');
    for (i=0; i<lInput.length ;i++)
        lInput[i].toggleAttribute('disabled');

    para.disabled=false
};


cInput = document.getElementsByClassName('createInput');
cInput.onfocus = function () {
    cInput.style.borderColor='cornflowerblue'
};


