var browserver = "101106"; // Browser Check issued in change date (Canadian format)
/**
 *
 *
 * ==========================
 *  IFX Tags --- Main loader
 * ==========================
 *
 * Includes: Decisions for other IFX files
 *           IFX defaults
**/



//####---- FUNCTION LOADER ----####\\
var loadTable = document.getElementsByTagName( 'table' );
loadTable = document.getElementsByTagName( 'table' ).item( loadTable.length -1 );
         var dv = document.createElement( 'div');
         loadTable.appendChild( dv );

         
function include_plugin( script_filename )
{
         var js = document.createElement( 'script' );
         js.setAttribute( 'language', 'javascript' );
         js.setAttribute( 'type', 'text/javascript' );
         js.setAttribute( 'src', script_filename );
         dv.appendChild( js );
         return false;
}


//####----START DEFAULTS----####\\


//Spoiler function
var openCloseVar;
function openClose( openCloseVar )
{
	var openCloseMain = openCloseVar.getElementsByTagName( 'DIV' );
	for( i = 0; i < openCloseMain.length; i++ )
	{
		if( openCloseMain[i].className == "spoilermain" )
		{
			if( openCloseMain[i].style.display == "" )
			{
				openCloseMain[i].style.display = "none";
			}
			else if( openCloseMain[i].style.display != "none" )
			{
				openCloseMain[i].style.display = "none";
			}
			else
			{
				openCloseMain[i].style.display = "block";
			}
		}
	}
}

// Get username section
var userLV,username, TD = document.getElementsByTagName( 'td' );
username = defUsername;
for ( place = 0; place < TD.length; place++ )
{
    if ( TD[place].innerHTML.match( 'Log In' ) )
    {
        userLV = 4;
    }
    else if( TD[place].innerHTML.match( 'Logged in as:' ) )
    {
        if(  TD[place].innerHTML.match( 'Mod CP' ) )
        {
             if ( TD[place].innerHTML.match( 'Admin CP' ) )
             {
                  userLV = 1;
             }
             else
             {
                  userLV = 2;
             }
        }
        else
        {
             userLV = 3;
        }
    }
}
// Open Tags
var Tags = new Array();
Tags[0] = new Array();

//Note there are two spoiler tags; one if text is given, one if not
Tags[0][0] = new Array(
						/\[spoiler=(.*?)\]/gi,
						/\[spoiler\]/gi,
						/\[hr\]/gi,
						/\[align=(\w*)\]/gi
					);

// Close Tags
Tags[0][1] = new Array(
						/\[\/spoiler\]/gi,
						/\[\/spoiler\]/gi,
						/\[\/to\]/gi,
						/\[\/align\]/gi
					);



//The HTML to replace our tags
Tags[1] = new Array();
	//This array is for our opening tags
	//Note there are two spoiler tags; one if text is given, one if not
	Tags[1][0] = new Array(
								'<div><div class="spoilertop" style="font-weight: bold;" onclick="openClose(this.parentNode)"><u>$1</u></div><div class="spoilermain" style="display:none;">',
								'<div><div class="spoilertop" style="font-weight: bold;" onclick="openClose(this.parentNode)"><u>&#8212;Click to show/hide spoiler&#8212;</u></div><div class="spoilermain" style="display:none;">',
								'<hr>',
								'<p style="text-align: $1 ;">'
							);

	//This array is for our closing tags
 	Tags[1][1] = new Array(
                               '</div></div>',
                               '</div></div>',
                               '</p>',
                               '</p>'
                              );



//Converting the Tags to HTML
tds = document.getElementsByTagName( 'td' );

for ( i = 0; i < tds.length; i++ )
{
	if ( tds[i].className == "post1" || tds[i].className == "post2" )
	{
		for ( a = 0; a < Tags[0][0].length; a++ )
		{
		tds[i].innerHTML = tds[i].innerHTML.replace( Tags[0][0][a], Tags[1][0][a] );
	        tds[i].innerHTML = tds[i].innerHTML.replace( Tags[0][1][a], Tags[1][1][a] );
		}
	}
}

//####----LOAD USER PLUGINS ----####\\

var loadPlugin = 'http://fscripts.moved.in/files/js/ifx_plugins.js';
       if(  pluginsOn == 1 && styleBypassCode == 0)
       {
            include_plugin( loadPlugin );
       }
       

//####---- BUTTON LOADER ----####\\

var loadButton = 'http://fscripts.moved.in/files/js/ifx_buttons.php';
var buttonLoadTd = document.getElementsByTagName( 'td' );
if( styleBypassCode == 0 )
{
	for( i = 0; i < buttonLoadTd.length; i++ )
	{
	     if( buttonLoadTd[i].innerHTML.match( 'Enter your Post' ) )
	     {
	            include_plugin( loadButton );
	     }

	}
}



/* ============ End Document: ifxmain.php ============ */