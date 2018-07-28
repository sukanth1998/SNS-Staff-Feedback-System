function valueChanged() {
    if (document.getElementById("four").checked == true) {
        document.getElementById("q14").checked = true;
        document.getElementById("q24").checked = true;
        document.getElementById("q34").checked = true;
        document.getElementById("q44").checked = true;
        document.getElementById("q54").checked = true;
    } else if(document.getElementById("three").checked == true) {
        document.getElementById("q13").checked = true;
        document.getElementById("q23").checked = true;
        document.getElementById("q33").checked = true;
        document.getElementById("q43").checked = true;
        document.getElementById("q53").checked = true;

    }else if(document.getElementById("two").checked == true) {
        document.getElementById("q12").checked = true;
        document.getElementById("q22").checked = true;
        document.getElementById("q32").checked = true;
        document.getElementById("q42").checked = true;
        document.getElementById("q52").checked = true;

    }
    else if(document.getElementById("one").checked == true) {
        document.getElementById("q11").checked = true;
        document.getElementById("q21").checked = true;
        document.getElementById("q31").checked = true;
        document.getElementById("q41").checked = true;
        document.getElementById("q51").checked = true;

    }else{
        return null;
    }
   

    
    
}




// $("input:checkbox").on('click', function() {
//     // in the handler, 'this' refers to the box clicked on
//     var $box = $(this);
//     if ($box.is(":checked")) {
//       // the name of the box is retrieved using the .attr() method
//       // as it is assumed and expected to be immutable
//       var group = "input:checkbox[name='" + $box.attr("name") + "']";
//       // the checked state of the group/box on the other hand will change
//       // and the current value is retrieved using .prop() method
//       $(group).prop("checked", false);
//       $box.prop("checked", true);
//     } else {
//       $box.prop("checked", false);
//     }
//   });