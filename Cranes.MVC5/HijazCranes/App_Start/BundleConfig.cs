using System.Web;
using System.Web.Optimization;

namespace HijazCranes
{
    public class BundleConfig
    {
        // For more information on bundling, visit https://go.microsoft.com/fwlink/?LinkId=301862
        public static void RegisterBundles(BundleCollection bundles)
        {
            // styles
            bundles.Add(new StyleBundle("~/Content/css").Include(
                      // bootstrap
                      "~/Content/bootstrap.min.css",
                      // dataTable
                      "~/Content/DataTables/css/jquery.dataTables.min.css",
                      "~/Content/DataTables/css/dataTables.bootstrap.min.css",
                      "~/Content/DataTables/css/dataTables.bootstrap4.min.css",
                      // toastr
                      "~/Content/toastr.min.css",
                      // select2
                      "~/Content/css/select2.min.css",
                      // font-awesome
                      "~/Content/font-awesome.min.css"
                      ));
            // scripts
            bundles.Add(new Bundle("~/bundles/js").Include(
                        // jquery
                        "~/Scripts/jquery-{version}.js",
                        // bootstrap
                        "~/Scripts/bootstrap.min.js",
                        // dataTable
                        "~/Scripts/DataTables/jquery.dataTables.min.js",
                        "~/Scripts/DataTables/dataTables.bootstrap4.min.js",
                        // toastr
                        "~/Scripts/toastr.js",
                        // select2
                        "~/Scripts/select2.js"
                        ));

            bundles.Add(new ScriptBundle("~/bundles/jqueryval").Include(
                        "~/Scripts/jquery.validate*"));

            // Use the development version of Modernizr to develop with and learn from. Then, when you're
            // ready for production, use the build tool at https://modernizr.com to pick only the tests you need.
            bundles.Add(new ScriptBundle("~/bundles/modernizr").Include(
                        "~/Scripts/modernizr-*"));
        }
    }
}