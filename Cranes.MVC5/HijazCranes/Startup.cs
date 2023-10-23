using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(HijazCranes.Startup))]
namespace HijazCranes
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
