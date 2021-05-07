// ------------------------------------------------------
// File    : /pub/desk/src/mod_pascal.c
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// ------------------------------------------------------
#include <stdio.h>
#include "apr_hash.h"
#include "ap_provider.h"
#include "httpd.h"
#include "http_core.h"
#include "http_config.h"
#include "http_log.h"
#include "http_protocol.h"
#include "http_request.h"

#pragma comment(lib, "E:\\Apache2.4\\apache\\lib\\libhttpd.lib")

static int pascal_handler(request_rec *r)
{
	// ---------------------------------------------------------
	// Check that the "pascal-handler" handler is being called.
	// ---------------------------------------------------------
	if (!r->handler || strcmp(r->handler, "pascal-handler")) return (DECLINED);
	
	ap_set_content_type(r, "text/plain");
	ap_rprintf(r, "Hallo Du\n");
	return OK;
}

static void register_hooks(apr_pool_t *pool) 
{
	ap_hook_handler(pascal_handler, NULL, NULL, APR_HOOK_LAST);
}

module AP_MODULE_DECLARE_DATA pascal_module =
{
	STANDARD20_MODULE_STUFF,
	NULL,			// Per-directory configuration handler
	NULL,			// Merge handler for per-directory configurations
	NULL,			// Per-server configuration handler
	NULL,			// Merge handler for per-server configurations
	NULL,			// Any directives we may have for httpd
	register_hooks	// Our hook registering function
};
