using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace HijazCranes.Models
{
    public class Quote 
    {
        public int Id { get; set; }
        public int Customer_Id { get; set; }
        public int Employee_Id { get; set; }
        public float? Discount { get; set; }
        public double Total { get; set; }


        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        public DateTime Created { get; set; } = DateTime.Now;


        [ForeignKey("Customer_Id")]
        public Customer Customer { get; set; }


        [ForeignKey("Employee_Id")]
        public Employee Employee { get; set; }


        public virtual List<QuoteCranes> QuoteCranes { get; set; }

        public double actual()
        {
            float discountRate = (float)(Discount / 100);
            float discount = 1 - discountRate;
            float actual = (float)(Total / discount);
            return Convert.ToDouble(actual);
        }
    }
}