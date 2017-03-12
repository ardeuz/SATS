function updateParent(property_id) {
  var parent = $('#parentData').val();
  var parentPcode = $('#parentData option:selected').html();
  var description = $('#parentData option:selected').attr("data-desc");

  $.post('build/ajax/updateParentData.php',{parent_id : parent, property_id: property_id},function(data){
    var result = parseInt(data);

    if (result == 1) {
      $("#parent_title_span").html(parentPcode);
      $("#parent_desc_span").html(description);
      //success
    } else {
      console.log(data);
    }
  });
}

function deleteParentProperty(property_id, parent_id) {
  if (property_id != -1) {
    if (confirm("Remove parent property?")) {
      $.post("build/ajax/deleteParentProperty.php", {property_id: property_id, parent_id: parent_id}, function(data) {
        var result = parseInt(data);

        if (result == 1) {
          $("#parent_title_span").html("None");
          $("#parent_desc_span").html("");
        } else {
          console.log(data);
        }
      });
    }
  }
}

function deleteSubProperty(sub_id, parent_id) {
  if (sub_id != -1) {
    if (confirm("Remove sub property?")) {
      var sub_desc = $("#sub_property_div" + sub_id).find("#sub_desc_span").html();
      var sub_pcode = $("#sub_property_div" + sub_id).find("#sub_title_span").html();

      $.post("build/ajax/deleteSubProperty.php", {sub_id: sub_id, parent_id: parent_id}, function(data) {
        var result = parseInt(data);

        if (result == 1) {
          $("#sub_property_div" + sub_id).remove(); //remove from list

          $("#sub_property_select")
          .append("<option data-desc='" + sub_desc + "' value=" + sub_id + ">" + sub_pcode + "</option>"); //add to select
        } else {
          console.log(data);
        }
      });
    }
  }
}

function addChildProperty(parent_id) {
  if ($("#sub_property_select option").length == 0) { //validate if there's something to add
    return;
  }

  var sub_id = $("#sub_property_select").val();
  var sub_pcode = $("#sub_property_select option:selected").html();
  var sub_desc = $("#sub_property_select option:selected").attr("data-desc");

  $.post("build/ajax/addChildProperty.php", {parent_id: parent_id, sub_id: sub_id}, function(data) {
    var result = parseInt(data);

    if (result == 1) {
      var sub_property_list_content = $("<div></div>")
        .addClass("list-content")
        .append("<span class='list-title' id='sub_title_span'>" + sub_pcode + "</span>")
        .append("<small class='list-subtitle' id='sub_desc_span' style='white-space: normal !important;'>" + sub_desc + "</small>"); //info about the sub property to add

      var sub_property_div = $("<div></div>")
        .addClass("list")
        .attr("id", "sub_property_div" + sub_id) //create the subproperty list div
        .click(function() {deleteSubProperty(sub_id, parent_id);})
        .append(sub_property_list_content);

        console.log(sub_property_div);

      $("#adminAccountabilityDialog").find("#sub_property_div").append(sub_property_div);

      $("#sub_property_select option:selected").remove(); //remove from select options
    } else if (result == -1) {
      //has already the sub property
    } else {
      console.log(data);
    }
  });
}
