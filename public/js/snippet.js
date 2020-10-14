var dragContainer = document.querySelector('.drag-container');
var itemContainers = [].slice.call(document.querySelectorAll('.board-column-content'));
var columnGrids = [];
var boardGrid;

// Init the column grids so we can drag those items around.
itemContainers.forEach(function (container) {
    var grid = new Muuri(container, {
        items: '.board-item',
        dragEnabled: true,
        dragSort: function () {
            return columnGrids;
        },

        dragStartPredicate: function (item, event) {
            // Prevent first item from being dragged.
            //console.log(item.getItems());

            $('.board-item-content').click(function () {

                //get code zone since twig template


                var res =  $(this).attr('value');
                console.log(res);

                if (grid.getItems().indexOf(item) === 0) {
                    console.log(grid.getItems().indexOf(item));
                    return false;
                }

            });

            /*if (grid.getItems().indexOf(item) === 0) {
                console.log(grid.getItems().indexOf(item));
                return false;
            }*/
            // For other items use the default drag start predicate.
            return Muuri.ItemDrag.defaultStartPredicate(item, event);
        },

        dragContainer: dragContainer,
        dragAutoScroll: {
            targets: (item) => {
                return [
                    { element: window, priority: 0 },
                    { element: item.getGrid().getElement().parentNode, priority: 1 },
                ];
            }
        },
    })
        .on('dragInit', function (item) {
            item.getElement().style.width = item.getWidth() + 'px';
            item.getElement().style.height = item.getHeight() + 'px';
        })
        .on('dragReleaseEnd', function (item) {
            item.getElement().style.width = '';
            item.getElement().style.height = '';
            item.getGrid().refreshItems([item]);

            //console.log(item);
            //console.log([item._gridId]);

            //call method update mood
            _ajax_update_mood_user(item._gridId)

        })
        .on('layoutStart', function () {
            boardGrid.refreshItems().layout();
        });

    columnGrids.push(grid);
});

// Init board grid so we can drag those columns around.
boardGrid = new Muuri('.board', {
    dragEnabled: true,
    dragHandle: '.board-column-header'
});


function _ajax_update_mood_user(gridId) {

    $.ajax({
        url: "/mood/ajax",
        type: "GET",
        dataType: "json",
        data: {
            grid_id: gridId
        },
        async: true,
        success: function(result) {
            if (result == true) {
                $("#success-alert").fadeTo(2000, 500)
                    .slideUp(500, function () {
                    $("#success-alert").slideUp(500);
                });
            } else {
                $("#warning-alert").fadeTo(2000, 500)
                    .slideUp(500, function () {
                    $("#warning-alert").slideUp(500);
                });
            }
        },
        statusCode: {
            //this is not ajax (la request n'est pas reçu par le controller)
            400: function () {
                $("#warning-alert").fadeTo(2000, 500)
                    .slideUp(500, function () {
                        $("#warning-alert").slideUp(500);
                    });
            },
            500: function () {
                $("#danger-alert").fadeTo(2000, 500)
                    .slideUp(500, function () {
                        $("#danger-alert").slideUp(500);
                    });
            }
        }
    })
    
}

function testiduser() {
    /*$('.board-item-content').click(function () {
        var res = $(this).attr('value');
        console.log(res);
        return res;
    })*/
}