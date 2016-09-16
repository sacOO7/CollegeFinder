package example;


import java.util.ArrayList;
import java.util.List;

/**
 * Created by sachin on 21/9/15.
 */
public class CollegeDataObject {
    List<CastDataObject> objects;
    String collegeName;
    String city;
    String UniversityName;
    public CollegeDataObject()
    {
        objects=new ArrayList<>();
        UniversityName="";
        city="Pune";
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getCollegeName() {
        return collegeName;
    }

    public void setCollegeName(String collegeName) {
        this.collegeName = collegeName;
    }

    public List<CastDataObject> getObjects() {
        return objects;
    }

    public void AddObject(CastDataObject object) {
        this.objects.add(object);
    }

    public String getUniversityName() {
        return UniversityName;
    }

    public void setUniversityName(String universityName) {
        UniversityName = universityName;
    }
}
