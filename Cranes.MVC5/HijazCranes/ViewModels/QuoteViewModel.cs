using HijazCranes.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace HijazCranes.ViewModels
{
    public class QuoteViewModel
    {
        public Quote Quote { get; set; }
        public List<QuoteCranes> QuoteCranes { get; set; }
        public QuoteCranes QuoteCrane { get; set; }
        public List<Crane> Cranes { get; set; }
        public List<Customer> Customers { get; set; }
        public Employee Employee { get; set; }
    }
}