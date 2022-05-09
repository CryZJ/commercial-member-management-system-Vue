//原“js/dynamic_table_init.js”文件
	function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {
	//获取节点
	var tab1 = $(".dynamic-table").html();//获取排序表1
	var tab2 = $(".dynamic-table_2").html();//获取排序表2
//	var tab3 = $(".dynamic-table_3").html();//获取排序表3
//	var tab4 = $(".dynamic-table_4").html();//获取排序表4
//	var tab5 = $(".dynamic-table_5").html();//获取排序表4
	//拆分数据
	var turn1 = tab1.split('/');
	var turn2 = tab2.split('/');
//	var turn3 = tab3.split('/');
//	var turn4 = tab4.split('/');
//	var turn5 = tab5.split('/');
	//排序设置
    $('#dynamic-table').dataTable( {
        "aaSorting": [[ turn1[0], turn1[1] ]],
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ]
    } );
	$('#dynamic-table_2').dataTable( {
        "aaSorting": [[ turn2[0], turn2[1] ]],
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ]
    } );
//  $('#dynamic-table_3').dataTable( {
//      "aaSorting": [[ turn3[0], turn3[1] ]],
//      "aoColumnDefs": [{
//              'bSortable': false,
//              'aTargets': [0]
//          }
//      ]
//  } );
//  $('#dynamic-table_4').dataTable( {
//      "aaSorting": [[ turn4[0], turn4[1] ]],
//      "aoColumnDefs": [{
//              'bSortable': false,
//              'aTargets': [0]
//          }
//      ]
//  } );
//  $('#dynamic-table_5').dataTable( {
//      "aaSorting": [[ turn5[0], turn5[1] ]],
//      "aoColumnDefs": [{
//              'bSortable': false,
//              'aTargets': [0]
//          }
//      ]
//  } );
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="images/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );