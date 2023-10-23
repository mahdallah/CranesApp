using HijazCranes.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace HijazCranes.ViewModels
{
    public class ReceiptViewModel
    {
        public Receipt Receipt { get; set; }
        public Quote Quote { get; set; }
        public Customer Customer { get; set; }
        public Employee Employee { get; set; }
        public List<Account> Accounts { get; set; }
        public List<QuoteCranes> QuoteCranes { get; set; }
    }
}