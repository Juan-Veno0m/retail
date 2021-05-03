$(document).ready(function(){
  var $ = go.GraphObject.make;
  var myDiagram =
    $(go.Diagram, "myDiagramDiv",
      {
        "undoManager.isEnabled": true,
        layout: $(go.TreeLayout,
                  { angle: 90, layerSpacing: 35 })
      });

  // the template we defined earlier
  myDiagram.nodeTemplate =
    $(go.Node, "Horizontal",
      { background: "#4b9f47" },
      $(go.TextBlock, "Default Text",
        { margin: 12, stroke: "white", font: "bold 16px sans-serif" },
        new go.Binding("text", "name"))
    );

  // define a Link template that routes orthogonally, with no arrowhead
  myDiagram.linkTemplate =
    $(go.Link,
      { routing: go.Link.Orthogonal, corner: 5 },
      $(go.Shape, // the link's path shape
        { strokeWidth: 3, stroke: "#555" }));

  var model = $(go.TreeModel);
  jQuery.get( "Tree", function( data ) {
    var arr = [];
    for (var i = 0; i < data.red.length; i++) {
      if (i==0) {
        arr.push({
          key: "" + data.parent['AsociadosID'],
          name: "Yo"
        });
      }
      arr.push({
        key: "" + data.red[i]['key'],
        parent: "" + data.red[i]['parent'],
        name: data.red[i]['Nombre']+' '+data.red[i]['ApellidoPaterno']
      });

    }
    model.nodeDataArray = arr;
  });

  myDiagram.model = model;
});
