using HijazCranes.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace HijazCranes.ViewModels
{
    public class CustomerFormViewModel
    {
        public Customer Customer { get; set; }
        public CustomerContact CustomerContact { get; set; }
    }
}