#include <stdio.h>
#include <dlfcn.h>

int main(int argc, char* argv[])
{
    void* handle = dlopen("./libhello.so", RTLD_LAZY);
    char* error = dlerror();
    if(!handle || error) {
        printf("load so error!\n");
        return 1;
    }

    void (*func)() = dlsym(handle, "hello");
    if(!func) {
        printf("load func error!\n");
        dlclose(handle);
        return 1;
    }
    func();
    dlclose(handle);
    return 0;
}

// gcc test.c -L. -lhello -ldl
