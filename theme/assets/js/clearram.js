function loaddestroy() {
    if (Model.ControlVisible()) {
        Model.DestroyControl();
    } else {
        Model.CreateControl();
    }
 
    // Run Chrome GC
    gc();
 
    setTimeout(loaddestroy, 1000);
}
 
loaddestroy();