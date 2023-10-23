using HijazCranes.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace HijazCranes.ViewModels
{
    public class HomeViewModel
    {
        public int Employees { get; set; }
        public int Customers { get; set; }
        public int Quotes { get; set; }
        public int Cranes { get; set; }
    }
}