using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using HijazCranes.Models;

namespace HijazCranes.ViewModels
{
    public class SaveQuoteViewModel
    {
        public Quote Quote { get; set; }
        public List<QuoteCranes> QuoteCranes { get; set; }
    }
}