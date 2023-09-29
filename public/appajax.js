var calls = [
  {url:'/getcategories',type: 'GET'},
  {url:'/getpokemons',type: 'GET'}
];

function runAjaxCalls(){
  if(calls.length > 0)
  {
    $.ajax(calls.shift()).then(runAjaxCalls);
  } else {
    if(window.localStorage)
    {
        if(!localStorage.getItem('reload'))
        {
            localStorage['reload'] = true;
            window.location.reload();
        } 
    }
  }
}


