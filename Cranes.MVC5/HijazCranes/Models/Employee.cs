using System;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Web;

namespace HijazCranes.Models
{
    public class Employee
    {
        public int Id { get; set; }


        [DisplayName("First Name")]
        public string FirstName { get; set; }


        [DisplayName("Middle Name")]
        public string MiddleName { get; set; }


        [DisplayName("Last Name")]
        public string LastName { get; set; }


        [DisplayName("Birth Date")]
        [DisplayFormat(DataFormatString = "{0:MMM dd yyyy}")]
        public DateTime? BirthDate { get; set; }

        public string Gender { get; set; }

        public string Position { get; set; }

        public double Salary { get; set; }


        [DataType(DataType.ImageUrl)]
        public string Image { get; set; }


        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        public DateTime Created { get; set; } = DateTime.Now;



        [DisplayName("Image File")]
        [NotMapped]
        public HttpPostedFileBase ImageFile { get; set; }
        [NotMapped]
        public string FullName => $"{FirstName} {LastName}";
    }
}