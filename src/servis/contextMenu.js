export function contectMenuShow(e, contextMenu){
    e.preventDefault();
    contextMenu.positon.x = e.pageX + 20
    contextMenu.positon.y = e.pageY - 20
}